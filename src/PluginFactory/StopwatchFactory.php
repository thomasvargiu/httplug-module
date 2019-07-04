<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\CachePlugin;
use Http\Client\Common\Plugin\StopwatchPlugin;
use Psr\Container\ContainerInterface;

class StopwatchFactory implements PluginFactory
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
            throw new \LogicException('To use the stopwatch plugin you need to install the "php-http/stopwatch-plugin" package.');
        }

        return new StopwatchPlugin($this->container->get($config['stopwatch']));
    }
}
