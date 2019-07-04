<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory\Authentication;

use Http\Message\Authentication;

class BearerFactory implements AuthenticationFactory
{
    public function createAuthentication(array $config = []): Authentication
    {
        return new Authentication\Bearer($config['token'] ?? '');
    }
}
