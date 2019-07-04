<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\PluginFactory;

use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\PluginFactory\StopwatchFactory;

class StopwatchFactoryFactory
{
    public function __invoke(ContainerInterface $container): StopwatchFactory
    {
        return new StopwatchFactory($container);
    }
}
