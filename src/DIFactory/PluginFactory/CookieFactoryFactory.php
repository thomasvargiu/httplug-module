<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\PluginFactory;

use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\PluginFactory\CookieFactory;

class CookieFactoryFactory
{
    public function __invoke(ContainerInterface $container): CookieFactory
    {
        return new CookieFactory($container);
    }
}
