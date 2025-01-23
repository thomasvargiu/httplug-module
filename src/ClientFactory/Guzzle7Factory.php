<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\ClientFactory;

use Psr\Http\Client\ClientInterface;
use Http\Adapter\Guzzle6\Client;
use LogicException;

use function class_exists;

class Guzzle7Factory implements ClientFactory
{
    /**
     * @param array<string, mixed> $config
     */
    public function createClient(array $config = []): ClientInterface
    {
        if (! class_exists(Client::class)) {
            throw new LogicException('To use the Guzzle6 adapter you need to install the "php-http/guzzle6-adapter" package.');
        }

        return Client::createWithConfig($config);
    }
}
