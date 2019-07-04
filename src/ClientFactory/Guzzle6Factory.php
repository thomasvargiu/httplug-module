<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\ClientFactory;

use Http\Client\HttpClient;
use Http\Adapter\Guzzle6\Client;
use function class_exists;
use LogicException;

class Guzzle6Factory implements ClientFactory
{
    public function createClient(array $config = []): HttpClient
    {
        if (! class_exists(Client::class)) {
            throw new LogicException('To use the Guzzle6 adapter you need to install the "php-http/guzzle6-adapter" package.');
        }

        return Client::createWithConfig($config);
    }
}
