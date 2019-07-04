<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\LoggerPlugin;
use Http\Message\Formatter;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use TMV\HTTPlugModule\PluginFactory\LoggerFactory;

class LoggerFactoryTest extends TestCase
{
    public function testCreatePlugin(): void
    {
        $config = [
            'logger' => 'foo',
            'formatter' => 'bar',
        ];

        $container = $this->prophesize(ContainerInterface::class);
        $logger = $this->prophesize(LoggerInterface::class);
        $formatter = $this->prophesize(Formatter::class);

        $container->get('foo')->willReturn($logger->reveal());
        $container->get('bar')->willReturn($formatter->reveal());

        $factory = new LoggerFactory($container->reveal());
        $plugin = $factory->createPlugin($config);

        $this->assertInstanceOf(LoggerPlugin::class, $plugin);
    }

    public function testCreatePluginWithOptionalFormatter(): void
    {
        $config = [
            'logger' => 'foo',
        ];

        $container = $this->prophesize(ContainerInterface::class);
        $logger = $this->prophesize(LoggerInterface::class);

        $container->get('foo')->willReturn($logger->reveal());

        $factory = new LoggerFactory($container->reveal());
        $plugin = $factory->createPlugin($config);

        $this->assertInstanceOf(LoggerPlugin::class, $plugin);
    }

    public function testCreatePluginWithDefaultLogger(): void
    {
        $config = [
        ];

        $container = $this->prophesize(ContainerInterface::class);
        $logger = $this->prophesize(LoggerInterface::class);

        $container->get(LoggerInterface::class)->willReturn($logger->reveal());

        $factory = new LoggerFactory($container->reveal());
        $plugin = $factory->createPlugin($config);

        $this->assertInstanceOf(LoggerPlugin::class, $plugin);
    }
}
