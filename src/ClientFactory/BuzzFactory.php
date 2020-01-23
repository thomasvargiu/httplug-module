<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\ClientFactory;

use Buzz\Client\FileGetContents;
use function class_exists;
use Http\Client\HttpClient;
use Psr\Http\Message\ResponseFactoryInterface;

class BuzzFactory implements ClientFactory
{
    /** @var ResponseFactoryInterface */
    private $responseFactory;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * @param array<string, mixed> $config
     *
     * @return HttpClient
     */
    public function createClient(array $config = []): HttpClient
    {
        if (! class_exists(FileGetContents::class)) {
            throw new \LogicException('To use the Buzz adapter you need to install the "kriswallsmith/buzz: ^1.0" package.');
        }

        return new FileGetContents($this->responseFactory, $config);
    }
}
