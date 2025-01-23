<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule;

use Http\Discovery\Psr17FactoryDiscovery;
use Laminas\ServiceManager\Factory\InvokableFactory;
use TMV\HTTPlugModule\ClientFactory\AutoDiscoveryFactory;
use TMV\HTTPlugModule\ClientFactory\BuzzFactory;
use TMV\HTTPlugModule\ClientFactory\CurlFactory;
use TMV\HTTPlugModule\ClientFactory\Guzzle6Factory;
use TMV\HTTPlugModule\ClientFactory\MockFactory;
use TMV\HTTPlugModule\ClientFactory\ReactFactory;
use TMV\HTTPlugModule\ClientFactory\SocketFactory;
use TMV\HTTPlugModule\DIFactory\ClientFactory\BuzzFactoryFactory;
use TMV\HTTPlugModule\DIFactory\ClientFactory\CurlFactoryFactory;
use TMV\HTTPlugModule\DIFactory\PluginFactoryManagerFactory;

class ConfigProvider
{
    /**
     * @return array<string, mixed>
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'httplug' => [
                'plugin_factory_manager' => [
                    'factories' => [
                        'cache' => PluginFactory\CacheFactory::class,
                        'add_host' => PluginFactory\AddHostFactory::class,
                        'add_path' => PluginFactory\AddPathFactory::class,
                        'authentication' => PluginFactory\AuthenticationFactory::class,
                        'base_uri' => PluginFactory\BaseUriFactory::class,
                        'content_length' => PluginFactory\ContentLengthFactory::class,
                        'content_type' => PluginFactory\ContentTypeFactory::class,
                        'cookie' => PluginFactory\CookieFactory::class,
                        'decoder' => PluginFactory\DecoderFactory::class,
                        'error' => PluginFactory\ErrorFactory::class,
                        'header_append' => PluginFactory\HeaderAppendFactory::class,
                        'header_defaults' => PluginFactory\HeaderDefaultsFactory::class,
                        'header_remove' => PluginFactory\HeaderRemoveFactory::class,
                        'header_set' => PluginFactory\HeaderSetFactory::class,
                        'history' => PluginFactory\HistoryFactory::class,
                        'logger' => PluginFactory\LoggerFactory::class,
                        'query_defaults' => PluginFactory\QueryDefaultsFactory::class,
                        'redirect' => PluginFactory\RedirectFactory::class,
                        'request_matcher' => PluginFactory\RequestMatcherFactory::class,
                        'retry' => PluginFactory\RetryFactory::class,
                        'stopwatch' => PluginFactory\StopwatchFactory::class,
                        'vcr_record' => PluginFactory\VcrRecordFactory::class,
                        'vcr_replay' => PluginFactory\VcrReplayFactory::class,
                    ],
                ],
                'authentication_factories' => [
                    'basic' => PluginFactory\Authentication\BasicFactory::class,
                    'bearer' => PluginFactory\Authentication\BearerFactory::class,
                    'wsse' => PluginFactory\Authentication\WsseFactory::class,
                    'query_param' => PluginFactory\Authentication\QueryParamFactory::class,
                ],

                // Global plugin configuration. When configured here, plugins need to be explicitly added to clients by service name.
                'plugins' => [],

                'clients' => [],
            ],
        ];
    }

    /**
     * @return array<string, array<mixed, mixed>>
     */
    public function getDependencies(): array
    {
        return [
            'abstract_factories' => [
                DIFactory\ClientAbstractFactory::class,
                DIFactory\FlexibleClientAbstractFactory::class,
                DIFactory\HttpMethodsClientAbstractFactory::class,
            ],
            'aliases' => [
                'httplug.client' => 'httplug.client.default',
                'httplug.client_factory.buz' => BuzzFactory::class,
                'httplug.client_factory.curl' => CurlFactory::class,
                'httplug.client_factory.guzzle6' => Guzzle6Factory::class,
                'httplug.client_factory.mock' => MockFactory::class,
                'httplug.client_factory.react' => ReactFactory::class,
                'httplug.client_factory.socket' => SocketFactory::class,
            ],
            'factories' => [
                'httplug.response_factory' => [Psr17FactoryDiscovery::class, 'findResponseFactory'],
                'httplug.request_factory' => [Psr17FactoryDiscovery::class, 'findRequestFactory'],
                'httplug.uri_factory' => [Psr17FactoryDiscovery::class, 'findUrlFactory'],
                'httplug.stream_factory' => [Psr17FactoryDiscovery::class, 'findStreamFactory'],
                // Client factories
                AutoDiscoveryFactory::class => InvokableFactory::class,
                BuzzFactory::class => BuzzFactoryFactory::class,
                CurlFactory::class => CurlFactoryFactory::class,
                Guzzle6Factory::class => InvokableFactory::class,
                MockFactory::class => InvokableFactory::class,
                ReactFactory::class => InvokableFactory::class,
                SocketFactory::class => InvokableFactory::class,
                // Authentication factories
                PluginFactory\Authentication\BasicFactory::class => InvokableFactory::class,
                PluginFactory\Authentication\BearerFactory::class => InvokableFactory::class,
                PluginFactory\Authentication\WsseFactory::class => InvokableFactory::class,
                PluginFactory\Authentication\QueryParamFactory::class => InvokableFactory::class,
                // Plugin factory manager
                PluginFactoryManager::class => PluginFactoryManagerFactory::class,
                // Plugin factories
                PluginFactory\CacheFactory::class => DIFactory\PluginFactory\CacheFactoryFactory::class,
                PluginFactory\AddHostFactory::class => DIFactory\PluginFactory\AddHostFactoryFactory::class,
                PluginFactory\AddPathFactory::class => DIFactory\PluginFactory\AddPathFactoryFactory::class,
                PluginFactory\AuthenticationFactory::class => DIFactory\PluginFactory\AuthenticationFactoryFactory::class,
                PluginFactory\BaseUriFactory::class => DIFactory\PluginFactory\BaseUriFactoryFactory::class,
                PluginFactory\ContentLengthFactory::class => InvokableFactory::class,
                PluginFactory\ContentTypeFactory::class => InvokableFactory::class,
                PluginFactory\CookieFactory::class => DIFactory\PluginFactory\CookieFactoryFactory::class,
                PluginFactory\DecoderFactory::class => InvokableFactory::class,
                PluginFactory\ErrorFactory::class => InvokableFactory::class,
                PluginFactory\HeaderAppendFactory::class => InvokableFactory::class,
                PluginFactory\HeaderDefaultsFactory::class => InvokableFactory::class,
                PluginFactory\HeaderRemoveFactory::class => InvokableFactory::class,
                PluginFactory\HeaderSetFactory::class => InvokableFactory::class,
                PluginFactory\HistoryFactory::class => DIFactory\PluginFactory\HistoryFactoryFactory::class,
                PluginFactory\LoggerFactory::class => DIFactory\PluginFactory\LoggerFactoryFactory::class,
                PluginFactory\QueryDefaultsFactory::class => InvokableFactory::class,
                PluginFactory\RedirectFactory::class => InvokableFactory::class,
                PluginFactory\RequestMatcherFactory::class => DIFactory\PluginFactory\RequestMatcherFactoryFactory::class,
                PluginFactory\RetryFactory::class => InvokableFactory::class,
                PluginFactory\StopwatchFactory::class => DIFactory\PluginFactory\StopwatchFactoryFactory::class,
                PluginFactory\VcrRecordFactory::class => DIFactory\PluginFactory\VcrRecordFactoryFactory::class,
                PluginFactory\VcrReplayFactory::class => DIFactory\PluginFactory\VcrReplayFactoryFactory::class,
            ],
        ];
    }
}
