<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\ContentTypePlugin;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\PluginFactory\ContentTypeFactory;
use Prophecy\PhpUnit\ProphecyTrait;

class ContentTypeFactoryTest extends TestCase
{
    use ProphecyTrait;

    public function testCreatePlugin(): void
    {
        $factory = new ContentTypeFactory();
        $plugin = $factory->createPlugin();

        $this->assertInstanceOf(ContentTypePlugin::class, $plugin);
    }
}
