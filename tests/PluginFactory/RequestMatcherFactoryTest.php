<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\RequestMatcherPlugin;
use Http\Message\RequestMatcher;
use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\PluginFactory\PluginFactory;
use TMV\HTTPlugModule\PluginFactory\RequestMatcherFactory;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\PluginFactoryManager;

class RequestMatcherFactoryTest extends TestCase
{

    public function testCreatePlugin(): void
    {
        $config = [
            'request_matcher' => 'foo-matcher',
            'success_plugin' => 'foo-success',
            'failure_plugin' => 'foo-failure',
        ];

        $container = $this->prophesize(ContainerInterface::class);
        $pluginFactoryManager = $this->prophesize(PluginFactoryManager::class);
        $requestMatcher = $this->prophesize(RequestMatcher::class);
        $successPlugin = $this->prophesize(Plugin::class);
        $failurePlugin = $this->prophesize(Plugin::class);

        $container->get('foo-matcher')->willReturn($requestMatcher->reveal());
        $container->get('foo-success')->willReturn($successPlugin->reveal());
        $container->get('foo-failure')->willReturn($failurePlugin->reveal());

        $factory = new RequestMatcherFactory(
            $container->reveal(),
            $pluginFactoryManager->reveal()
        );

        $plugin = $factory->createPlugin($config);

        $this->assertInstanceOf(RequestMatcherPlugin::class, $plugin);
    }

    public function testCreatePluginWithoutPlugins(): void
    {
        $config = [
            'request_matcher' => 'foo-matcher',
        ];

        $container = $this->prophesize(ContainerInterface::class);
        $pluginFactoryManager = $this->prophesize(PluginFactoryManager::class);
        $requestMatcher = $this->prophesize(RequestMatcher::class);

        $container->get('foo-matcher')->willReturn($requestMatcher->reveal());

        $factory = new RequestMatcherFactory(
            $container->reveal(),
            $pluginFactoryManager->reveal()
        );

        $plugin = $factory->createPlugin($config);

        $this->assertInstanceOf(RequestMatcherPlugin::class, $plugin);
    }

    public function testCreatePluginWithPluginFactory(): void
    {
        $config = [
            'request_matcher' => 'foo-matcher',
            'success_plugin' => [
                'name' => 'foo-success',
                'config' => [
                    'foo' => 'bar',
                ],
            ],
            'failure_plugin' => [
                'name' => 'foo-failure',
                'config' => [
                    'foo2' => 'bar2',
                ],
            ],
        ];

        $container = $this->prophesize(ContainerInterface::class);
        $pluginFactoryManager = $this->prophesize(PluginFactoryManager::class);
        $requestMatcher = $this->prophesize(RequestMatcher::class);
        $successPlugin = $this->prophesize(Plugin::class);
        $failurePlugin = $this->prophesize(Plugin::class);

        $container->get('foo-matcher')->willReturn($requestMatcher->reveal());

        $pluginFactorySuccess = $this->prophesize(PluginFactory::class);
        $pluginFactoryFailure = $this->prophesize(PluginFactory::class);

        $pluginFactorySuccess->createPlugin(['foo' => 'bar'])->shouldBeCalled()->willReturn($successPlugin->reveal());
        $pluginFactoryFailure->createPlugin(['foo2' => 'bar2'])->shouldBeCalled()->willReturn($failurePlugin->reveal());

        $pluginFactoryManager->getFactory('foo-success')->willReturn($pluginFactorySuccess->reveal());
        $pluginFactoryManager->getFactory('foo-failure')->willReturn($pluginFactoryFailure->reveal());

        $factory = new RequestMatcherFactory(
            $container->reveal(),
            $pluginFactoryManager->reveal()
        );

        $plugin = $factory->createPlugin($config);

        $this->assertInstanceOf(RequestMatcherPlugin::class, $plugin);
    }
}
