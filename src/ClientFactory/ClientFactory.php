<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\ClientFactory;

use Psr\Http\Client\ClientInterface;

interface ClientFactory
{
    /**
     * @param array<string, mixed> $config
     */
    public function createClient(array $config = []): ClientInterface;
}
