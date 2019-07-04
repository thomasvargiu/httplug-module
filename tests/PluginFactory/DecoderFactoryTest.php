<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\DecoderPlugin;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\PluginFactory\DecoderFactory;

class DecoderFactoryTest extends TestCase
{
    public function testCreatePlugin(): void
    {
        $factory = new DecoderFactory();
        $plugin = $factory->createPlugin();

        $this->assertInstanceOf(DecoderPlugin::class, $plugin);
    }
}
