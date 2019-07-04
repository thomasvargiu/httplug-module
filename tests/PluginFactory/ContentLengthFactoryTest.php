<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\ContentLengthPlugin;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\PluginFactory\ContentLengthFactory;

class ContentLengthFactoryTest extends TestCase
{
    public function testCreatePlugin(): void
    {
        $factory = new ContentLengthFactory();
        $plugin = $factory->createPlugin();

        $this->assertInstanceOf(ContentLengthPlugin::class, $plugin);
    }
}
