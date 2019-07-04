<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\ClientFactory;

use Http\Adapter\React\Client;
use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use LogicException;
use function class_exists;

class ReactFactory implements ClientFactory
{
    /** @var MessageFactory */
    private $messageFactory;
    /**
     * @param MessageFactory $messageFactory
     */
    public function __construct(MessageFactory $messageFactory)
    {
        $this->messageFactory = $messageFactory;
    }

    public function createClient(array $config = []): HttpClient
    {
        if (!class_exists('Http\Adapter\React\Client')) {
            throw new LogicException('To use the React adapter you need to install the "php-http/react-adapter" package.');
        }

        return new Client($this->messageFactory);
    }
}
