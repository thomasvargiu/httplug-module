<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory\Authentication;

use Http\Message\Authentication;

class BasicFactory implements AuthenticationFactory
{
    public function createAuthentication(array $config = []): Authentication
    {
        return new Authentication\BasicAuth(
            $config['username'] ?? '',
            $config['password'] ?? ''
        );
    }
}
