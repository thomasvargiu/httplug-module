<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Psr\Http\Message\UriFactoryInterface;

class BaseUriFactory implements PluginFactory
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

    /**
     * @param array<string, mixed> $config
     *
     * @return Plugin
     */
    public function createPlugin(array $config = []): Plugin
    {
        return new BaseUriPlugin(
            $this->uriFactory->createUri($config['uri'] ?? ''),
            $config['host_config'] ?? []
        );
    }
}
