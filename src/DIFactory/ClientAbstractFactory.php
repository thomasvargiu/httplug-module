<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory;

use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Interop\Container\ContainerInterface;
use InvalidArgumentException;
use function is_array;
use function is_string;
use TMV\HTTPlugModule\ClientFactory\AutoDiscoveryFactory;
use TMV\HTTPlugModule\ClientFactory\ClientFactory;
use TMV\HTTPlugModule\PluginFactoryManager;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\AbstractFactoryInterface;

class ClientAbstractFactory implements AbstractFactoryInterface
{
    protected function getServiceTypeName(): string
    {
        return 'clients';
    }

    public function canCreate(ContainerInterface $container, $requestedName): bool
    {
        if (! preg_match('/^httplug\.clients\.[^.]+$/', $requestedName)) {
            return false;
        }

        [,, $clientName] = explode('.', $requestedName);

        $config = $container->get('config')['httplug']['clients'][$clientName] ?? null;

        return is_array($config);
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
     * @return HttpClient
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): HttpClient
    {
        if (! preg_match('/^httplug\.clients\.[^.]+$/', $requestedName)) {
            throw new InvalidArgumentException('Invalid service name');
        }

        [,, $clientName] = explode('.', $requestedName);

        $config = $container->get('config')['httplug']['clients'][$clientName] ?? null;

        if (! is_array($config)) {
            throw new InvalidArgumentException('Invalid service name');
        }

        if (! empty($config['service'])) {
            $client = $container->get($config['service']);
        } else {
            /** @var ClientFactory $factory */
            $factory = $container->get($config['factory'] ?? AutoDiscoveryFactory::class);
            $client = $factory->createClient($config['config'] ?? []);
        }

        $plugins = $this->retrievePlugins($container, $config['plugins'] ?? []);

        if (0 === count($plugins)) {
            return $client;
        }

        return new PluginClient(
            $client,
            $plugins
        );
    }

    private function retrievePlugins(ContainerInterface $container, array $config): array
    {
        /** @var PluginFactoryManager $pluginFactoryManager */
        $pluginFactoryManager = $container->get(PluginFactoryManager::class);

        $plugins = [];

        foreach ($config as $nameOrConfig) {
            if (is_string($nameOrConfig)) {
                $plugins[] = $container->get($nameOrConfig);
                continue;
            }

            if (! is_array($nameOrConfig) || ! is_string($nameOrConfig['name'] ?? null)) {
                throw new InvalidArgumentException('Invalid client plugin');
            }

            $plugins[] = $pluginFactoryManager->getFactory($nameOrConfig['name'])
                ->createPlugin($nameOrConfig['config'] ?? []);
        }

        return $plugins;
    }
}
