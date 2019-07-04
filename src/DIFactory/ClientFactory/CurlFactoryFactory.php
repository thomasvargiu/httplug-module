<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\ClientFactory;

use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\ClientFactory\CurlFactory;

class CurlFactoryFactory
{
    public function __invoke(ContainerInterface $container): CurlFactory
    {
        return new CurlFactory(
            $container->get('httplug.response_factory'),
            $container->get('httplug.stream_factory')
        );
    }
}

