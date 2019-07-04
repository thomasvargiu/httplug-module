<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\ClientFactory;

use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\ClientFactory\BuzzFactory;

class BuzzFactoryFactory
{
    public function __invoke(ContainerInterface $container): BuzzFactory
    {
        return new BuzzFactory($container->get('httplug.message_factory'));
    }
}
