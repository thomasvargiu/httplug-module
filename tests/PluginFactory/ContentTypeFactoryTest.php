<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\ContentTypePlugin;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\PluginFactory\ContentTypeFactory;

class ContentTypeFactoryTest extends TestCase
{
    public function testCreatePlugin(): void
    {
        $factory = new ContentTypeFactory();
        $plugin = $factory->createPlugin();

        $this->assertInstanceOf(ContentTypePlugin::class, $plugin);
    }
}
