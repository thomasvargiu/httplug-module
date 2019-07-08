<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\ClientFactory;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use TMV\HTTPlugModule\ClientFactory\CurlFactory;

class CurlFactoryFactory
{
    public function __invoke(ContainerInterface $container): CurlFactory
    {
        /** @var ResponseFactoryInterface $responseFactory */
        $responseFactory = $container->get('httplug.response_factory');

        /** @var StreamFactoryInterface $streamFactory */
        $streamFactory = $container->get('httplug.stream_factory');

        return new CurlFactory($responseFactory, $streamFactory);
    }
}
