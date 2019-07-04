<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\ClientFactory;

use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\ClientFactory\ReactFactory;

class ReactFactoryFactory
{
    public function __invoke(ContainerInterface $container): ReactFactory
    {
        return new ReactFactory(
            $container->get('httplug.message_factory')
        );
    }
}
