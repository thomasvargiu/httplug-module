<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\ClientFactory;

use Psr\Http\Client\ClientInterface;
use Http\Client\Socket\Client;
use LogicException;

use function class_exists;

class SocketFactory implements ClientFactory
{
    /**
     * @param array<string, mixed> $config
     */
    public function createClient(array $config = []): ClientInterface
    {
        if (! class_exists(Client::class)) {
            throw new LogicException('To use the Socket client you need to install the "php-http/socket-client" package.');
        }

        return new Client($config);
    }
}
