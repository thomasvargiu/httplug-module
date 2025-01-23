<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\ClientFactory;

use Psr\Http\Client\ClientInterface;
use Http\Adapter\React\Client;
use LogicException;

use function class_exists;

class ReactFactory implements ClientFactory
{
    public function __construct() {}

    /**
     * @param array<string, mixed> $config
     */
    public function createClient(array $config = []): ClientInterface
    {
        if (! class_exists(Client::class)) {
            throw new LogicException('To use the React adapter you need to install the "php-http/react-adapter" package.');
        }

        return new Client();
    }
}
