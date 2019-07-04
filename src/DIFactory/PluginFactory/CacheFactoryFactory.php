<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\PluginFactory;

use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\PluginFactory\CacheFactory;

class CacheFactoryFactory
{
    public function __invoke(ContainerInterface $container): CacheFactory
    {
        return new CacheFactory($container);
    }
}
