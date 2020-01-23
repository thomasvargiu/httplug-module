<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\ClientFactory;

use function class_exists;
use Http\Client\HttpClient;
use Http\Client\Socket\Client;
use Http\Message\MessageFactory;
use LogicException;

class SocketFactory implements ClientFactory
{
    /** @var MessageFactory */
    private $messageFactory;

    public function __construct(MessageFactory $messageFactory)
    {
        $this->messageFactory = $messageFactory;
    }

    /**
     * @param array<string, mixed> $config
     *
     * @return HttpClient
     */
    public function createClient(array $config = []): HttpClient
    {
        if (! class_exists(Client::class)) {
            throw new LogicException('To use the Socket client you need to install the "php-http/socket-client" package.');
        }

        return new Client($this->messageFactory, $config);
    }
}
