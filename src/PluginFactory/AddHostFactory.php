<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\AddHostPlugin;
use Psr\Http\Message\UriFactoryInterface;

class AddHostFactory implements PluginFactory
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
        return new AddHostPlugin(
            $this->uriFactory->createUri($config['host'] ?? ''),
            $config['options'] ?? []
        );
    }
}
