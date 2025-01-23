<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\DIFactory;

use Http\Client\Common\Plugin;
use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;
use Laminas\ServiceManager\Factory\AbstractFactoryInterface;
use TMV\HTTPlugModule\PluginFactoryManager;

use function count;
use function explode;
use function is_array;
use function strpos;

class PluginAbstractFactory implements AbstractFactoryInterface
{
    protected function getServiceTypeName(): string
    {
        return 'plugins';
    }

    /**
     * @param string $requestedName
     *
     * @return array<string, string|array<string, mixed>>|null
     *
     * @phpstan-return null|array{0: string, 1: array<string, mixed>}
     *
     * @psalm-return null|array{0: string, 1: array<string, mixed>}
     */
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

    /**
     * @param string $requestedName
     */
    public function canCreate(ContainerInterface $container, $requestedName): bool
    {
        return is_array($this->getPluginConfig($container, $requestedName));
    }

    /**
     * Create an object.
     *
     * @param string $requestedName
     * @param null|array<string, mixed> $options
     *
     * @throws ServiceNotFoundException if unable to resolve the service
     * @throws ServiceNotCreatedException if an exception is raised when
     *                                    creating a service
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): Plugin
    {
        [$pluginName, $config] = $this->getPluginConfig($container, $requestedName);

        /** @var PluginFactoryManager $pluginFactoryManager */
        $pluginFactoryManager = $container->get(PluginFactoryManager::class);

        return $pluginFactoryManager->getFactory($pluginName)->createPlugin($config);
    }
}
