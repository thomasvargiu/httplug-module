<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\ClientFactory;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use TMV\HTTPlugModule\ClientFactory\BuzzFactory;

class BuzzFactoryFactory
{
    public function __invoke(ContainerInterface $container): BuzzFactory
    {
        /** @var ResponseFactoryInterface $responseFactory */
        $responseFactory = $container->get('httplug.response_factory');

        return new BuzzFactory($responseFactory);
    }
}
