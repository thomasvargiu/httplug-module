<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\AddPathPlugin;
use Psr\Http\Message\UriFactoryInterface;

class AddPathFactory implements PluginFactory
{
    /** @var UriFactoryInterface */
    private $uriFactory;

    /**
     * AddHostFactory constructor.
     *
     * @param UriFactoryInterface $uriFactory
     */
    public function __construct(UriFactoryInterface $uriFactory)
    {
        $this->uriFactory = $uriFactory;
    }

    public function createPlugin(array $config = []): Plugin
    {
        return new AddPathPlugin($this->uriFactory->createUri($config['path'] ?? ''));
    }
}
