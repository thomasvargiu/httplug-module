<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\ClientFactory;

use Http\Client\HttpClient;
use Buzz\Client\FileGetContents;
use Http\Adapter\Buzz\Client as Adapter;
use Http\Message\MessageFactory;
use function class_exists;

class BuzzFactory implements ClientFactory
{
    /** @var MessageFactory */
    private $messageFactory;

    public function __construct(MessageFactory $messageFactory)
    {
        $this->messageFactory = $messageFactory;
    }

    public function createClient(array $config = []): HttpClient
    {
        if (! class_exists('Http\Adapter\Buzz\Client')) {
            throw new \LogicException('To use the Buzz adapter you need to install the "php-http/buzz-adapter" package.');
        }

        $client = new FileGetContents();
        $client->setTimeout($config['timeout'] ?? 5);
        $client->setVerifyPeer($config['verify_peer'] ?? true);
        $client->setVerifyHost($config['verify_host'] ?? 2);
        $client->setProxy($config['proxy'] ?? null);

        return new Adapter($client, $this->messageFactory);
    }
}
