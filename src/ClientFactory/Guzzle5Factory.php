<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\ClientFactory;

use function class_exists;
use GuzzleHttp\Client;
use Http\Adapter\Guzzle5\Client as Adapter;
use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use LogicException;

class Guzzle5Factory implements ClientFactory
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
        if (! class_exists('Http\Adapter\Guzzle5\Client')) {
            throw new LogicException('To use the Guzzle5 adapter you need to install the "php-http/guzzle5-adapter" package.');
        }

        $client = new Client($config);

        return new Adapter($client, $this->messageFactory);
    }
}
