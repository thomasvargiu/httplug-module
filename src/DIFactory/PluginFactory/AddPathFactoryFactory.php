<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory\PluginFactory;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\UriFactoryInterface;
use TMV\HTTPlugModule\PluginFactory\AddPathFactory;

class AddPathFactoryFactory
{
    public function __invoke(ContainerInterface $container): AddPathFactory
    {
        /** @var UriFactoryInterface $uriFactory */
        $uriFactory = $container->get('httplug.uri_factory');

        return new AddPathFactory($uriFactory);
    }
}
