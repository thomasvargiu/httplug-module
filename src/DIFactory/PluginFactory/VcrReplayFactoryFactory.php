<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\PluginFactory;

use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\PluginFactory\VcrReplayFactory;

class VcrReplayFactoryFactory
{
    public function __invoke(ContainerInterface $container): VcrReplayFactory
    {
        return new VcrReplayFactory($container);
    }
}
