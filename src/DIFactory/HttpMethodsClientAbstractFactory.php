<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory;

use function explode;
use Http\Client\Common\HttpMethodsClient;
use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Interop\Container\ContainerInterface;
use InvalidArgumentException;
use function preg_match;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\AbstractFactoryInterface;

class HttpMethodsClientAbstractFactory implements AbstractFactoryInterface
{
    /**
     * Can the factory create an instance for the service?
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     *
     * @return bool
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
     * Create an object
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     *
     * @throws ServiceNotFoundException if unable to resolve the service
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service
     *
     * @return HttpMethodsClient
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): HttpMethodsClient
    {
        if (! preg_match('/^httplug\.clients\.[^.]+\.http_methods$/', $requestedName)) {
            throw new InvalidArgumentException('Invalid service name');
        }

        [,, $clientName] = explode('.', $requestedName);

        /** @var HttpClient $httpClient */
        $httpClient = $container->get('httplug.clients.' . $clientName);

        /** @var MessageFactory $messageFactory */
        $messageFactory = $container->get('httplug.message_factory');

        return new HttpMethodsClient(
            $httpClient,
            $messageFactory
        );
    }
}
