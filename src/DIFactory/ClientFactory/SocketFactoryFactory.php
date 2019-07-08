<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\ClientFactory;

use Http\Message\MessageFactory;
use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\ClientFactory\SocketFactory;

class SocketFactoryFactory
{
    public function __invoke(ContainerInterface $container): SocketFactory
    {
        /** @var MessageFactory $messageFactory */
        $messageFactory = $container->get('httplug.message_factory');

        return new SocketFactory($messageFactory);
    }
}
