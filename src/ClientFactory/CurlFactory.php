<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\ClientFactory;

use Psr\Http\Client\ClientInterface;
use Http\Client\Curl\Client;
use LogicException;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

use function class_exists;
use function constant;
use function is_string;
use function sprintf;

class CurlFactory implements ClientFactory
{
    private ResponseFactoryInterface $responseFactory;

    private StreamFactoryInterface $streamFactory;

    public function __construct(ResponseFactoryInterface $responseFactory, StreamFactoryInterface $streamFactory)
    {
        $this->responseFactory = $responseFactory;
        $this->streamFactory = $streamFactory;
    }

    /**
     * @param array<int|string, mixed> $config
     */
    public function createClient(array $config = []): ClientInterface
    {
        if (! class_exists(Client::class)) {
            throw new LogicException('To use the Curl client you need to install the "php-http/curl-client" package.');
        }

        // Try to resolve curl constant names
        foreach ($config as $key => $value) {
            // If the $key is a string we assume it is a constant
            if (! is_string($key)) {
                continue;
            }

            if (null === ($constantValue = constant($key))) {
                throw new LogicException(sprintf('Key %s is not an int nor a CURL constant', $key));
            }

            unset($config[$key]);
            $config[$constantValue] = $value;
        }

        return new Client($this->responseFactory, $this->streamFactory, $config);
    }
}
