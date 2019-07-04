<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\ClientFactory;

use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\ClientFactory\Guzzle5Factory;

class Guzzle5FactoryFactory
{
    public function __invoke(ContainerInterface $container): Guzzle5Factory
    {
        return new Guzzle5Factory(
            $container->get('httplug.message_factory')
        );
    }
}
