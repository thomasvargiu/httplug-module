<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory\Authentication;

use Http\Message\Authentication;

class WsseFactory implements AuthenticationFactory
{
    /**
     * @param array<string, mixed> $config
     */
    public function createAuthentication(array $config = []): Authentication
    {
        return new Authentication\Wsse(
            $config['username'] ?? '',
            $config['password'] ?? ''
        );
    }
}
