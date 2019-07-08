<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory;

use function explode;
use Http\Client\Common\FlexibleHttpClient;
use Interop\Container\ContainerInterface;
use InvalidArgumentException;
use function preg_match;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\AbstractFactoryInterface;

class FlexibleClientAbstractFactory implements AbstractFactoryInterface
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
        if (! preg_match('/^httplug\.clients\.[^.]+\.flexible$/', $requestedName)) {
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
     * @return FlexibleHttpClient
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): FlexibleHttpClient
    {
        if (! preg_match('/^httplug\.clients\.[^.]+\.flexible$/', $requestedName)) {
            throw new InvalidArgumentException('Invalid service name');
        }

        [,, $clientName] = explode('.', $requestedName);

        return new FlexibleHttpClient($container->get('httplug.clients.' . $clientName));
    }
}
