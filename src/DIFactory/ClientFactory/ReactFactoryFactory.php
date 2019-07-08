<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\ClientFactory;

use Http\Message\MessageFactory;
use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\ClientFactory\ReactFactory;

class ReactFactoryFactory
{
    public function __invoke(ContainerInterface $container): ReactFactory
    {
        /** @var MessageFactory $messageFactory */
        $messageFactory = $container->get('httplug.message_factory');

        return new ReactFactory($messageFactory);
    }
}
