<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory;

use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Interop\Container\ContainerInterface;
use InvalidArgumentException;
use TMV\HTTPlugModule\ClientFactory\AutoDiscoveryFactory;
use TMV\HTTPlugModule\ClientFactory\ClientFactory;
use TMV\HTTPlugModule\PluginFactoryManager;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use function is_array;
use function is_string;

class ClientAbstractFactory extends AbstractServiceFactory
{

    protected function getServiceTypeName(): string
    {
        return 'clients';
    }

    /**
     * Create an object
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return HttpClient
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): HttpClient
    {
        $config = $this->getServiceConfig($container, $requestedName);

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
