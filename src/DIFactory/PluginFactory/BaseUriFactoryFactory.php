<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\PluginFactory;

use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\PluginFactory\BaseUriFactory;

class BaseUriFactoryFactory
{
    public function __invoke(ContainerInterface $container): BaseUriFactory
    {
        return new BaseUriFactory($container->get('httplug.uri_factory'));
    }
}
