<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\PluginFactory;

use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\PluginFactory\LoggerFactory;

class LoggerFactoryFactory
{
    public function __invoke(ContainerInterface $container): LoggerFactory
    {
        return new LoggerFactory($container);
    }
}
