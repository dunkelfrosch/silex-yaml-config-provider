YamlConfigServiceProvider
=========================

Service provider for Silex for using YAML configuration files. This provider based on a fork of Alexander Kluth <contact@alexanderkluth.com> yaml-config service provider available on [Github](https://github.com/deralex/YamlConfigServiceProvider) including minor improvements and changes to run up the latest version of php(7).      

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)
[![Build Status](https://travis-ci.org/dunkelfrosch/silex-yaml-config-provider.svg?branch=master)](https://travis-ci.org/dunkelfrosch/silex-yaml-config-provider)

Installation
--------------

To use it add following line to your composer.json:

    "require": {
        ...
        "df/yaml-config-provider": "^1.0"
        ...
    }


Usage
--------------
Include following line of code somewhere in your initial Silex file (index.php or whatever):

    $app->register(new DF\Silex\YamlConfigServiceProvider(PATH_TO_CONFIG));

Now you have access to all of your configuration variables through `$app['config']`.


Example
---------------

config.yml:

    database:
        host: localhost
        user: myuser
        password: mypassword

index.php:

    <?php
        require_once __DIR__.'/../vendor/autoload.php';

        $app = new Silex\Application();

        // Considering the config.yml files is in the same directory as index.php
        $app->register(new DF\Silex\YamlConfigServiceProvider('config.yml'));

        echo $app['config']['database']['host'];
        ...

License
----------------
Copyright (c) 2016 Patrick Paechnatz <patrick.paechnatz@gmail.com>
                                                                           
Permission is hereby granted,  free of charge,  to any  person obtaining a 
copy of this software and associated documentation files (the "Software"), 
to deal in the Software without restriction,  including without limitation 
the rights to use,  copy, modify, merge, publish,  distribute, sublicense, 
and/or sell copies  of the  Software,  and to permit  persons to whom  the 
Software is furnished to do so, subject to the following conditions:       
                                                                           
The above copyright notice and this permission notice shall be included in 
all copies or substantial portions of the Software.                        
                                                                           
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR 
IMPLIED, INCLUDING  BUT NOT  LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
FITNESS FOR A PARTICULAR  PURPOSE AND  NONINFRINGEMENT.  IN NO EVENT SHALL 
THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER 
LIABILITY,  WHETHER IN AN ACTION OF CONTRACT,  TORT OR OTHERWISE,  ARISING 
FROM,  OUT OF  OR IN CONNECTION  WITH THE  SOFTWARE  OR THE  USE OR  OTHER 
DEALINGS IN THE SOFTWARE.                                                  
