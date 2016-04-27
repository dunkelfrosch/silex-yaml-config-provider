<?php

namespace DF\Silex\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlConfigServiceProvider
 * 
 * @package DF\Silex\Provider
 */
class YamlConfigServiceProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $file;

    /**
     * @param $file
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $config = Yaml::parse(file_get_contents($this->file));

        if (is_array($config)) {
            $this->importSearch($config, $app);

            if (isset($app['config']) && is_array($app['config'])) {
                $app['config'] = array_replace_recursive($app['config'], $config);
            } else {
                $app['config'] = $config;
            }
        }
    }

    /**
     * looks for import directives
     *
     * @param array $config
     */
    public function importSearch(&$config, $app) {
        foreach ($config as $key => $value) {
            if ($key == 'imports') {
                foreach ($value as $resource) {
                    $base_dir = str_replace(basename($this->file), '', $this->file);
                    $new_config = new YamlConfigServiceProvider($base_dir . $resource['resource']);
                    $new_config->register($app);
                }
                unset($config['imports']);
            }
        }
    }

    /**
     * @return string
     */
    public function getConfigFile()
    {
        return $this->file;
    }
}

