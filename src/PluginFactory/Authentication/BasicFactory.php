<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory\Authentication;

use Http\Message\Authentication;

class BasicFactory implements AuthenticationFactory
{
    /**
     * @param array<string, mixed> $config
     *
     * @return Authentication
     */
    public function createAuthentication(array $config = []): Authentication
    {
        return new Authentication\BasicAuth(
            $config['username'] ?? '',
            $config['password'] ?? ''
        );
    }
}
