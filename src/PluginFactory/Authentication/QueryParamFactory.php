<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory\Authentication;

use Http\Message\Authentication;

class QueryParamFactory implements AuthenticationFactory
{
    /**
     * @param array<string, mixed> $config
     */
    public function createAuthentication(array $config = []): Authentication
    {
        return new Authentication\QueryParam($config['parameters'] ?? '');
    }
}
