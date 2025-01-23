<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory\Authentication;

use Http\Message\Authentication;

interface AuthenticationFactory
{
    /**
     * @param array<string, mixed> $config
     */
    public function createAuthentication(array $config = []): Authentication;
}
