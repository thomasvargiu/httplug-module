<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\Adapter;

use Http\Message\StreamFactory as HttpStreamFactory;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;

class StreamFactory implements HttpStreamFactory
{
    /** @var StreamFactoryInterface */
    private $streamFactory;

    /**
     * StreamFactoryDecorator constructor.
     *
     * @param StreamFactoryInterface $streamFactory
     */
    public function __construct(StreamFactoryInterface $streamFactory)
    {
        $this->streamFactory = $streamFactory;
    }

    /**
     * Creates a new PSR-7 stream.
     *
     * @param string|resource|StreamInterface|null $body
     *
     * @throws \InvalidArgumentException if the stream body is invalid
     * @throws \RuntimeException         if creating the stream from $body fails
     *
     * @return StreamInterface
     */
    public function createStream($body = null)
    {
        if (\is_resource($body)) {
            return $this->streamFactory->createStreamFromResource($body);
        }

        return $this->streamFactory->createStream((string) ($body ?: ''));
    }
}
