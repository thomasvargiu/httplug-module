<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\ClientFactory;

use Buzz\Client\FileGetContents;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseFactoryInterface;

use function class_exists;

class BuzzFactory implements ClientFactory
{
    private ResponseFactoryInterface $responseFactory;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function createClient(array $config = []): ClientInterface
    {
        if (! class_exists(FileGetContents::class)) {
            throw new \LogicException('To use the Buzz adapter you need to install the "kriswallsmith/buzz: ^1.0" package.');
        }

        return new FileGetContents($this->responseFactory, $config);
    }
}
