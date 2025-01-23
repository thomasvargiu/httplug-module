<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\HistoryPlugin;
use Http\Client\Common\Plugin\Journal;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\PluginFactory\HistoryFactory;
use Prophecy\PhpUnit\ProphecyTrait;

class HistoryFactoryTest extends TestCase
{
    use ProphecyTrait;

    public function testCreatePlugin(): void
    {
        $config = [
            'journal' => 'foo',
        ];
        $container = $this->prophesize(ContainerInterface::class);
        $journal = $this->prophesize(Journal::class);

        $container->get('foo')->willReturn($journal->reveal());

        $factory = new HistoryFactory($container->reveal());
        $plugin = $factory->createPlugin($config);

        $this->assertInstanceOf(HistoryPlugin::class, $plugin);
    }
}
