<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\PluginFactory;

use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\PluginFactory\AddPathFactory;

class AddPathFactoryFactory
{
    public function __invoke(ContainerInterface $container): AddPathFactory
    {
        return new AddPathFactory($container->get('httplug.uri_factory'));
    }
}
