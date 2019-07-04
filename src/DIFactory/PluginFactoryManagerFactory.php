<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory;

use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\PluginFactoryManager;
use function array_map;

class PluginFactoryManagerFactory
{
    public function __invoke(ContainerInterface $container): PluginFactoryManager
    {
        $factories = $container->get('config')['httplug']['plugin_factory_manager']['factories'] ?? [];

        return new PluginFactoryManager(array_map([$container, 'get'], $factories));
    }
}
