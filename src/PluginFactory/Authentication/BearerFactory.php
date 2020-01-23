<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory\Authentication;

use Http\Message\Authentication;

class BearerFactory implements AuthenticationFactory
{
    /**
     * @param array<string, mixed> $config
     *
     * @return Authentication
     */
    public function createAuthentication(array $config = []): Authentication
    {
        return new Authentication\Bearer($config['token'] ?? '');
    }
}
