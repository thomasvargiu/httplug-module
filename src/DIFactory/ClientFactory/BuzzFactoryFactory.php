<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\ClientFactory;

use Http\Message\MessageFactory;
use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\ClientFactory\BuzzFactory;

class BuzzFactoryFactory
{
    public function __invoke(ContainerInterface $container): BuzzFactory
    {
        /** @var MessageFactory $messageFactory */
        $messageFactory = $container->get('httplug.message_factory');

        return new BuzzFactory($messageFactory);
    }
}
