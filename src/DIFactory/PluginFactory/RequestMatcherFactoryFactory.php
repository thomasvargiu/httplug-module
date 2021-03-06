<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\PluginFactory;

use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\PluginFactory\RequestMatcherFactory;

class RequestMatcherFactoryFactory
{
    public function __invoke(ContainerInterface $container): RequestMatcherFactory
    {
        return new RequestMatcherFactory($container);
    }
}
