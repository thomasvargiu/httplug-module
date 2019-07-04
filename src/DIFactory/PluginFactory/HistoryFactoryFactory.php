<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\PluginFactory;

use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\PluginFactory\HistoryFactory;

class HistoryFactoryFactory
{
    public function __invoke(ContainerInterface $container): HistoryFactory
    {
        return new HistoryFactory($container);
    }
}
