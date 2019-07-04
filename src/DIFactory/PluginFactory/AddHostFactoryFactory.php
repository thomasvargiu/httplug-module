<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\PluginFactory;

use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\PluginFactory\AddHostFactory;

class AddHostFactoryFactory
{
    public function __invoke(ContainerInterface $container): AddHostFactory
    {
        return new AddHostFactory($container->get('httplug.uri_factory'));
    }
}
