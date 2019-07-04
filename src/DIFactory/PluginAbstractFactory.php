<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory;

use function count;
use function explode;
use Http\Client\Common\Plugin;
use Interop\Container\ContainerInterface;
use function is_array;
use function strpos;
use TMV\HTTPlugModule\PluginFactoryManager;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\AbstractFactoryInterface;

class PluginAbstractFactory implements AbstractFactoryInterface
{
    protected function getServiceTypeName(): string
    {
        return 'plugins';
    }

    private function getPluginConfig(ContainerInterface $container, $requestedName): ?array
    {
        if (0 !== strpos($requestedName, 'httplug.plugins.')) {
            return null;
        }

        $exploded = explode('.', $requestedName);

        if (4 !== count($exploded)) {
            return null;
        }

        [,, $pluginName, $serviceName] = $exploded;

        $config = $container->get('config')['httplug']['plugins'][$pluginName][$serviceName] ?? null;

        if (! is_array($config)) {
            return null;
        }

        return [$pluginName, $config];
    }

    public function canCreate(ContainerInterface $container, $requestedName): bool
    {
        return is_array($this->getPluginConfig($container, $requestedName));
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
     * @return Plugin
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): Plugin
    {
        [$pluginName, $config] = $this->getPluginConfig($container, $requestedName);

        /** @var PluginFactoryManager $pluginFactoryManager */
        $pluginFactoryManager = $container->get(PluginFactoryManager::class);

        return $pluginFactoryManager->getFactory($pluginName)->createPlugin($config);
    }
}
