<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\ContentLengthPlugin;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\PluginFactory\ContentLengthFactory;
use Prophecy\PhpUnit\ProphecyTrait;

class ContentLengthFactoryTest extends TestCase
{
    use ProphecyTrait;
    public function testCreatePlugin(): void
    {
        $factory = new ContentLengthFactory();
        $plugin = $factory->createPlugin();

        $this->assertInstanceOf(ContentLengthPlugin::class, $plugin);
    }
}
