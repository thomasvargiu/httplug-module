<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\ClientFactory;

use Http\Client\HttpClient;
use Http\Client\Socket\Client;
use Http\Message\MessageFactory;
use LogicException;
use function class_exists;

class SocketFactory implements ClientFactory
{
    /** @var MessageFactory */
    private $messageFactory;

    public function __construct(MessageFactory $messageFactory)
    {
        $this->messageFactory = $messageFactory;
    }

    public function createClient(array $config = []): HttpClient
    {
        if (!class_exists('Http\Client\Socket\Client')) {
            throw new LogicException('To use the Socket client you need to install the "php-http/socket-client" package.');
        }

        return new Client($this->messageFactory, $config);
    }
}
