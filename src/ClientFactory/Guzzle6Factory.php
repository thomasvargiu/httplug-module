<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\ClientFactory;

use function class_exists;
use Http\Adapter\Guzzle6\Client;
use Http\Client\HttpClient;
use LogicException;

class Guzzle6Factory implements ClientFactory
{
    /**
     * @param array<string, mixed> $config
     *
     * @return HttpClient
     */
    public function createClient(array $config = []): HttpClient
    {
        if (! class_exists(Client::class)) {
            throw new LogicException('To use the Guzzle6 adapter you need to install the "php-http/guzzle6-adapter" package.');
        }

        return Client::createWithConfig($config);
    }
}
