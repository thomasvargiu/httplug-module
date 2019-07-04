<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest;

use TMV\HTTPlugModule\PluginFactory\PluginFactory;
use TMV\HTTPlugModule\PluginFactoryManager;
use PHPUnit\Framework\TestCase;

class PluginFactoryManagerTest extends TestCase
{

    public function testGetFactory(): void
    {
        $factory = $this->prophesize(PluginFactory::class);
        $manager = new PluginFactoryManager([
            'foo' => $factory->reveal(),
        ]);

        $result = $manager->getFactory('foo');

        $this->assertSame($result, $factory->reveal());
    }

    public function testHas(): void
    {
        $factory = $this->prophesize(PluginFactory::class);
        $manager = new PluginFactoryManager([
            'foo' => $factory->reveal(),
        ]);

        $this->assertTrue($manager->has('foo'));
        $this->assertFalse($manager->has('bar'));
    }

    public function testAll(): void
    {
        $factory = $this->prophesize(PluginFactory::class);

        $factories = [
            'foo' => $factory->reveal(),
        ];

        $manager = new PluginFactoryManager($factories);

        $this->assertSame($factories, $manager->all());
    }
}
