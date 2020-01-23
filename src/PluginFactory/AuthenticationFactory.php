<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use InvalidArgumentException;

class AuthenticationFactory implements PluginFactory
{
    /** @var array<string, Authentication\AuthenticationFactory> */
    private $factories;

    /**
     * AuthenticationFactory constructor.
     *
     * @param array<string, Authentication\AuthenticationFactory> $factories
     */
    public function __construct(array $factories)
    {
        $this->factories = $factories;
    }

    /**
     * @param array<string, mixed> $config
     *
     * @return Plugin
     */
    public function createPlugin(array $config = []): Plugin
    {
        $options = $config['options'] ?? [];
        $type = $config['type'] ?? null;

        /** @var null|Authentication\AuthenticationFactory $authFactory */
        $authFactory = $this->factories[$type] ?? null;

        if (! $authFactory instanceof Authentication\AuthenticationFactory) {
            throw new InvalidArgumentException('Unsupported authentication type');
        }

        return new AuthenticationPlugin($authFactory->createAuthentication($options));
    }
}
