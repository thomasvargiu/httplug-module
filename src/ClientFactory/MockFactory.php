<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\ClientFactory;

use function class_exists;
use Http\Client\HttpClient;
use Http\Mock\Client;
use LogicException;

class MockFactory implements ClientFactory
{
    /** @var HttpClient */
    private $client;

    public function __construct(HttpClient $client = null)
    {
        if (! class_exists(Client::class)) {
            throw new LogicException('To use the mock adapter you need to install the "php-http/mock-client" package.');
        }

        $this->client = $client ?: new Client();
    }

    public function createClient(array $config = []): HttpClient
    {
        return $this->client;
    }
}
