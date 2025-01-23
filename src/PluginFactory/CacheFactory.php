<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\CachePlugin;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\StreamFactoryInterface;
use TMV\HTTPlugModule\Adapter\StreamFactory;

class CacheFactory implements PluginFactory
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param array<string, mixed> $config
     *
     * @return Plugin
     */
    public function createPlugin(array $config = []): Plugin
    {
        if (! class_exists(CachePlugin::class)) {
            throw new \LogicException('To use the cache plugin you need to install the "php-http/cache-plugin" package.');
        }

        $options = $config['options'] ?? [];

        if ($options['cache_key_generator'] ?? null) {
            $options['cache_key_generator'] = $this->container->get($options['cache_key_generator']);
        }

        /** @var CacheItemPoolInterface $cachePool */
        $cachePool = $this->container->get($config['cache_pool']);

        /** @var StreamFactoryInterface $streamFactory */
        $streamFactory = $this->container->get($config['stream_factory'] ?? 'httplug.stream_factory');

        return new CachePlugin(
            $cachePool,
            $streamFactory,
            $options
        );
    }
}
