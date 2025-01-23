<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\AddPathPlugin;
use Psr\Http\Message\UriFactoryInterface;

class AddPathFactory implements PluginFactory
{
    private UriFactoryInterface $uriFactory;

    /**
     * AddHostFactory constructor.
     */
    public function __construct(UriFactoryInterface $uriFactory)
    {
        $this->uriFactory = $uriFactory;
    }

    /**
     * @param array<string, mixed> $config
     */
    public function createPlugin(array $config = []): Plugin
    {
        return new AddPathPlugin($this->uriFactory->createUri($config['path'] ?? ''));
    }
}
