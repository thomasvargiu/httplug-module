<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Http\Client\Common\HttpMethodsClient;
use Psr\Container\ContainerInterface;
use InvalidArgumentException;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;
use Laminas\ServiceManager\Factory\AbstractFactoryInterface;

use function explode;
use function preg_match;

class HttpMethodsClientAbstractFactory implements AbstractFactoryInterface
{
    /**
     * Can the factory create an instance for the service?
     *
     * @param string $requestedName
     */
    public function canCreate(ContainerInterface $container, $requestedName): bool
    {
        if (! preg_match('/^httplug\.clients\.[^.]+\.http_methods$/', $requestedName)) {
            return false;
        }

        [,, $clientName] = explode('.', $requestedName);

        return $container->has('httplug.clients.' . $clientName);
    }

    /**
     * Create an object.
     *
     * @param string $requestedName
     * @param null|array<mixed> $options
     *
     * @throws ServiceNotFoundException if unable to resolve the service
     * @throws ServiceNotCreatedException if an exception is raised when
     *                                    creating a service
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): HttpMethodsClient
    {
        if (! preg_match('/^httplug\.clients\.[^.]+\.http_methods$/', $requestedName)) {
            throw new InvalidArgumentException('Invalid service name');
        }

        [,, $clientName] = explode('.', $requestedName);

        /** @var ClientInterface $httpClient */
        $httpClient = $container->get('httplug.clients.' . $clientName);

        /** @var RequestFactoryInterface $requestFactory */
        $requestFactory = $container->get('httplug.request_factory');

        /** @var StreamFactoryInterface $streamFactory */
        $streamFactory = $container->get('httplug.stream_factory');

        return new HttpMethodsClient(
            $httpClient,
            $requestFactory,
            $streamFactory
        );
    }
}
