<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\ClientFactory;

use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\ClientFactory\SocketFactory;

class SocketFactoryFactory
{
    public function __invoke(ContainerInterface $container): SocketFactory
    {
        return new SocketFactory(
            $container->get('httplug.message_factory')
        );
    }
}
