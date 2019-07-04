# HTTPlug Module

[![Latest Stable Version](https://poser.pugx.org/thomasvargiu/httplug-module/v/stable)](https://packagist.org/packages/thomasvargiu/httplug-module)
[![Total Downloads](https://poser.pugx.org/thomasvargiu/httplug-module/downloads)](https://packagist.org/packages/thomasvargiu/httplug-module)
[![License](https://poser.pugx.org/thomasvargiu/httplug-module/license)](https://packagist.org/packages/thomasvargiu/httplug-module)
[![Code Coverage](https://scrutinizer-ci.com/g/thomasvargiu/httplug-module/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/thomasvargiu/httplug-module/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/thomasvargiu/httplug-module/badges/build.png?b=master)](https://scrutinizer-ci.com/g/thomasvargiu/httplug-module/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/thomasvargiu/httplug-module/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/thomasvargiu/httplug-module/?branch=master)

HTTPlug Module for zend-framework and zend-expressive.

Visit [http://httplug.io/](http://httplug.io/) for more info.

## Installation

```
composer require thomasvargiu/httplug-module
```

## Full configuration

```php
return [
    'httplug' => [
        // Global plugin configuration. When configured here, plugins need to be explicitly added to clients by service name.
        'plugins' => [
            'authentication' => [
                // The names can be freely chosen, the authentication type is specified in the "type" option
                'my_basic' => [
                    'type' => 'basic',
                    'options' => [
                        'username' => 'my_username',
                        'password' => 'p4ssw0rd',
                    ],
                ],
            ],
            'cache' => [
                'default' => [
                    // requires the php-http/cache-plugin package to be installed in your package
                    'cache_pool' => 'my_cache_pool',
                    'stream_factory' => 'httplug.stream_factory', // default to "httplug.stream_factory"
                    'options' => [
                        'default_ttl' => 3600,
                        'respect_cache_headers' => true,
                        'cache_key_generator' => null, // This must be a service id to a service implementing 'Http\Client\Common\Plugin\Cache\Generator\CacheKeyGenerator'. If 'null' 'Http\Client\Common\Plugin\Cache\Generator\SimpleGenerator' will be used.
                    ],
                ],
            ],
            'cookie' => [
                'default' => [
                    'cookie_jar' => 'my_cookie_jar_service',
                ],
            ],
            'decoder' => [
                'default' => [
                    'use_content_encoding' => true,
                ],
            ],
            'history' => [
                'default' => [
                    'journal' => 'my_journal',
                ],
            ],
            'logger' => [
                'default' => [
                    'logger' => 'logger',
                    'formatter' => null,
                ],
            ],
            'redirect' => [
                'default' => [
                    'preserve_header' => true,
                    'use_default_for_multiple' => true,
                ],
            ],
            'retry' => [
                'default' => [
                    'retry' => 1,
                ],
            ],
            'stopwatch' => [
                'default' => [
                    'stopwatch' => 'debug.stopwatch',
                ],
            ],
        ],

        'clients' => [
            'default' => [
                'factory' => 'httplug.client_factory.guzzle6',
                'service' => 'my_service',       // Can not be used with "factory" or "config"
                'config' => [
                    // Options to the Guzzle 6 constructor
                    'timeout' => 2,
                ],
                'plugins' => [
                    // Can reference a globally configured plugin service
                    'httplug.plugin.authentication.my_wsse',
                    // Can configure a plugin customized for this client
                    [
                        'name' => 'cache',
                        'config' => [
                            'cache_pool' => 'my_other_pool',
                            'options' => [
                                'default_ttl' => 120,
                            ],
                        ],
                    ],
                    // Can configure plugins that can not be configured globally
                    [
                        'name' => 'add_host',
                        'config' => [
                            // Host name including protocol and optionally the port number, e.g. https://api.local:8000
                            'host' => 'http://localhost:80', // Required
                            'options' => [
                                // Whether to replace the host if request already specifies it
                                'replace' => false,
                            ],
                        ],
                    ],
                    [
                        'name' => 'add_path',
                        'config' => [
                            // Path to be added, e.g. /api/v1
                            'path' => '/api/v1', // Required
                        ],
                    ],
                    [
                        'name' => 'base_uri',
                        'config' => [
                            // Base Uri including protocol, optionally the port number and prepend path, e.g. https://api.local:8000/api
                            'uri' => 'http://localhost:80', // Required
                            'host_config' => [
                                // Whether to replace the host if request already specifies one
                                'replace' => false,
                            ],
                        ],
                    ],
                    // Set content-type header based on request body, if the header is not already set
                    [
                        'name' => 'content_type',
                        'config' => [
                            // skip content-type detection if body is larger than size_limit
                            'skip_detection' => true,
                            // size_limit in bytes for when skip_detection is enabled
                            'size_limit' => 200000,
                        ],
                    ],
                    // Append headers to the request. If the header already exists the value will be appended to the current value.
                    [
                        'name' => 'header_append',
                        'config' => [
                            // Keys are the header names, values the header values
                            'headers' => [
                                'X-FOO' => 'bar',
                            ],
                        ],
                    ],
                    // Set header to default value if it does not exist.
                    [
                        'name' => 'header_defaults',
                        'config' => [
                            // Keys are the header names, values the header values
                            'headers' => [
                                'X-FOO' => 'bar',
                            ],
                        ],
                    ],
                    // Set headers to requests. If the header does not exist it wil be set, if the header already exists it will be replaced.
                    [
                        'name' => 'header_set',
                        'config' => [
                            // Keys are the header names, values the header values
                            'headers' => [
                                'X-FOO' => 'bar',
                            ],
                        ],
                    ],
                    // Remove headers from requests.
                    [
                        'name' => 'header_remove',
                        'config' => [
                            // List of header names to remove
                            'headers' => ['X-FOO'],
                        ],
                    ],
                    // Sets query parameters to default value if they are not present in the request.
                    [
                        'name' => 'query_defaults',
                        'config' => [
                            'parameters' => [
                                'locale' => 'en',
                            ],
                        ],
                    ],
                    [
                        // VCR replay should be placed before the VCR record
                        'name' => 'vcr_replay',
                        'config' => [
                            'fixtures_directory' => 'data/fixtures/http', // mandatory for "filesystem" player
                            'player' => 'filesystem',  // Can be filesystem, in_memory or the id of your custom player
                            'naming_strategy' => 'service_id.of.naming_strategy', // or "default"
                            'naming_strategy_options' => [
                                // options for the default naming strategy, see VCR plugin documentation
                                'hash_headers' => [],
                                'hash_body_methods' => [],
                            ],
                            'throw' => true,
                        ],
                    ],
                    [
                        'name' => 'vcr_record',
                        'config' => [
                            'fixtures_directory' => 'data/fixtures/http', // mandatory for "filesystem" recorder
                            'recorder' => 'filesystem',  // Can be filesystem, in_memory or the id of your custom recorder
                            'naming_strategy' => 'service_id.of.naming_strategy', // or "default"
                            'naming_strategy_options' => [
                                // options for the default naming strategy, see VCR plugin documentation
                                'hash_headers' => [],
                                'hash_body_methods' => [],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
```

## Clients

```php
$client = $container->get('httplug.clients.default');
```

### Flexible Clients
```php
$client = $container->get('httplug.clients.default.flexible');
```

### Http Methods Clients
```php
$client = $container->get('httplug.clients.default.http_methods');
```
