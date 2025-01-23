<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\StopwatchPlugin;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Symfony\Component\Stopwatch\Stopwatch;
use TMV\HTTPlugModule\PluginFactory\StopwatchFactory;
use Prophecy\PhpUnit\ProphecyTrait;

class StopwatchFactoryTest extends TestCase
{
    use ProphecyTrait;
    public function testCreatePlugin(): void
    {
        $config = [
            'stopwatch' => 'foo',
        ];

        $container = $this->prophesize(ContainerInterface::class);
        $stopwatch = $this->prophesize(Stopwatch::class);

        $container->get('foo')->willReturn($stopwatch->reveal());

        $factory = new StopwatchFactory($container->reveal());

        $plugin = $factory->createPlugin($config);

        $this->assertInstanceOf(StopwatchPlugin::class, $plugin);
    }
}
