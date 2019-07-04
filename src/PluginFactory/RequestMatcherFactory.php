<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\RequestMatcherPlugin;
use Http\Message\RequestMatcher;
use InvalidArgumentException;
use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\PluginFactoryManager;
use function is_string;

class RequestMatcherFactory implements PluginFactory
{
    /** @var ContainerInterface */
    private $container;

    /** @var PluginFactoryManager */
    private $pluginFactoryManager;

    /**
     * RequestMatcherFactory constructor.
     * @param ContainerInterface $container
     * @param PluginFactoryManager $pluginFactoryManager
     */
    public function __construct(ContainerInterface $container, PluginFactoryManager $pluginFactoryManager)
    {
        $this->container = $container;
        $this->pluginFactoryManager = $pluginFactoryManager;
    }

    public function createPlugin(array $config = []): Plugin
    {
        $requestMatcherName = $config['request_matcher'] ?? null;

        if (! is_string($requestMatcherName)) {
            throw new InvalidArgumentException('Invalid request matcher name');
        }

        $requestMatcher = $this->container->get($requestMatcherName);

        if (! $requestMatcher instanceof RequestMatcher) {
            throw new InvalidArgumentException('Invalid request matcher');
        }

        $successPlugin = $config['success_plugin'] ?? null;
        $failurePlugin = $config['failure_plugin'] ?? null;

        return new RequestMatcherPlugin(
            $requestMatcher,
            $successPlugin ? $this->getPlugin($successPlugin) : null,
            $failurePlugin ? $this->getPlugin($failurePlugin) : null
        );
    }

    private function getPlugin($plugin): Plugin
    {
        if (is_string($plugin)) {
            return $this->container->get($plugin);
        }

        if (! \is_array($plugin)) {
            throw new InvalidArgumentException('Invalid plugin');
        }

        $name = $plugin['name'] ?? null;

        if (! is_string($name)) {
            throw new InvalidArgumentException('Invalid plugin name');
        }

        return $this->pluginFactoryManager->getFactory($name)->createPlugin($plugin['config'] ?? []);
    }
}
