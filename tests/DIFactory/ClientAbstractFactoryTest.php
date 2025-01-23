<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\DIFactory;

use Http\Client\Common\Plugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Psr\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\ClientFactory\ClientFactory;
use TMV\HTTPlugModule\DIFactory\ClientAbstractFactory;
use TMV\HTTPlugModule\PluginFactory\PluginFactory;
use TMV\HTTPlugModule\PluginFactoryManager;
use Prophecy\PhpUnit\ProphecyTrait;

class ClientAbstractFactoryTest extends TestCase
{
    use ProphecyTrait;
    public function testHappyPath(): void
    {
        $requestedName = 'httplug.clients.foo';
        $config = [
            'httplug' => [
                'clients' => [
                    'foo' => [
                        'factory' => 'client-factory',
                        'config' => [
                            'foo' => 'bar',
                        ],
                        'plugins' => [
                            'foo-plugin',
                            [
                                'name' => 'bar-plugin',
                                'config' => [
                                    'foo2' => 'bar2',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $container = $this->prophesize(ContainerInterface::class);
        $clientFactory = $this->prophesize(ClientFactory::class);
        $pluginFactoryManager = $this->prophesize(PluginFactoryManager::class);
        $pluginFactory = $this->prophesize(PluginFactory::class);
        $client = $this->prophesize(HttpClient::class);
        $plugin1 = $this->prophesize(Plugin::class);
        $plugin2 = $this->prophesize(Plugin::class);

        $container->get('config')->willReturn($config);
        $container->get('client-factory')
            ->willReturn($clientFactory->reveal());
        $container->get(PluginFactoryManager::class)
            ->willReturn($pluginFactoryManager->reveal());
        $container->get('foo-plugin')
            ->shouldBeCalled()
            ->willReturn($plugin1->reveal());

        $clientFactory->createClient(['foo' => 'bar'])
            ->willReturn($client->reveal());

        $pluginFactoryManager->getFactory('bar-plugin')
            ->willReturn($pluginFactory->reveal());

        $pluginFactory->createPlugin(['foo2' => 'bar2'])
            ->shouldBeCalled()
            ->willReturn($plugin2->reveal());

        $factory = new ClientAbstractFactory();

        $output = $factory($container->reveal(), $requestedName);

        $this->assertInstanceOf(PluginClient::class, $output);
    }
}
