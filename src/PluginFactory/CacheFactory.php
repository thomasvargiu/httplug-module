<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\CachePlugin;
use Psr\Container\ContainerInterface;

class CacheFactory implements PluginFactory
{
    /** @var ContainerInterface */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function createPlugin(array $config = []): Plugin
    {
        if (! class_exists(CachePlugin::class)) {
            throw new \LogicException('To use the cache plugin you need to install the "php-http/cache-plugin" package.');
        }

        $options = $config['options'] ?? [];

        if ($options['cache_key_generator'] ?? null) {
            $options['cache_key_generator'] = $this->container->get($options['cache_key_generator']);
        }

        return new CachePlugin(
            $this->container->get($config['cache_pool']),
            $this->container->get($config['stream_factory'] ?? 'httplug.stream_factory'),
            $options
        );
    }
}
