<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\PluginFactory;

use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\PluginFactory\AuthenticationFactory;

class AuthenticationFactoryFactory
{
    public function __invoke(ContainerInterface $container): AuthenticationFactory
    {
        $factories = \array_map([$container, 'get'], $container->get('config')['httplug']['authentication_factories'] ?? []);

        return new AuthenticationFactory($factories);
    }
}
