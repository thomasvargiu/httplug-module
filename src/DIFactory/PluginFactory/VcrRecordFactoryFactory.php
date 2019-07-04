<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\PluginFactory;

use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\PluginFactory\VcrRecordFactory;

class VcrRecordFactoryFactory
{
    public function __invoke(ContainerInterface $container): VcrRecordFactory
    {
        return new VcrRecordFactory($container);
    }
}
