<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\CachePlugin;
use Http\Client\Common\Plugin\LoggerPlugin;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class LoggerFactory implements PluginFactory
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
            throw new \LogicException('To use the logger plugin you need to install the "php-http/logger-plugin" package.');
        }

        $formatter = $config['formatter'] ?? null;

        return new LoggerPlugin(
            $this->container->get($config['logger'] ?? LoggerInterface::class),
            $formatter ? $this->container->get($formatter) : null
        );
    }
}
