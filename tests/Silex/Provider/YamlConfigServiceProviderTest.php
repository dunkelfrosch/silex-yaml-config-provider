<?php

namespace DF\Tests\Silex\Provider;

use Pimple\Container;
use Silex\Application;
use DF\Silex\Provider\YamlConfigServiceProvider;

/**
 * Class YamlConfigServiceProviderTest
 * 
 * @package DF\Tests\Silex\Provider
 */
class YamlConfigServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    const TEST_YAML_FILE = 'config.yml';

    /** 
     * @var Container $app 
     */
    protected $app;

    public function testCanHandleASimpleConfigBlock()
    {
        $this->assertEquals('localhost', $this->app['config']['database']['host']);
        $this->assertEquals('12345', $this->app['config']['database']['port']);
        $this->assertEquals('myTestUser', $this->app['config']['database']['user']);
        $this->assertEquals('myTestPassword', $this->app['config']['database']['password']);
    }

    public function testCanHandleStringConfigBlock()
    {
        $this->assertEquals('my string content 1', $this->app['config']['strings']['simple_no_quotes']);
        $this->assertEquals('my string content 2', $this->app['config']['strings']['single_quote_string']);
        $this->assertEquals('my string content 3', $this->app['config']['strings']['double_quote_string']);
        $this->assertEquals(sprintf('a double-quoted string in my YAML%s', PHP_EOL), $this->app['config']['strings']['double_quote_string_with_newline']);
    }

    public function testCanHandleSimpleArray()
    {
        $myYamlArray = $this->app['config']['arrays']['simple_single_dim_array'];

        $this->assertTrue(is_array($myYamlArray));
        $this->assertEquals(3, count($myYamlArray));
        $this->assertEquals(0, array_search('php', $myYamlArray));
        $this->assertEquals(1, array_search('perl', $myYamlArray));
        $this->assertEquals(2, array_search('python', $myYamlArray));
    }

    protected function setUp()
    {
        parent::setUp();

        $this->app = new Application;
        $this->app->register(new YamlConfigServiceProvider(sprintf('%s/../../resources/%s', __DIR__, self::TEST_YAML_FILE)));
    }
}