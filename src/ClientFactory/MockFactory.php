<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\ClientFactory;

use Psr\Http\Client\ClientInterface;
use Http\Mock\Client;
use LogicException;

use function class_exists;

class MockFactory implements ClientFactory
{
    private ClientInterface $client;

    public function __construct(ClientInterface $client = null)
    {
        if (! class_exists(Client::class)) {
            throw new LogicException('To use the mock adapter you need to install the "php-http/mock-client" package.');
        }

        $this->client = $client ?: new Client();
    }

    public function createClient(array $config = []): ClientInterface
    {
        return $this->client;
    }
}
