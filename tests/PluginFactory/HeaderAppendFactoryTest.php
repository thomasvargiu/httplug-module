<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\HeaderAppendPlugin;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\PluginFactory\HeaderAppendFactory;

class HeaderAppendFactoryTest extends TestCase
{
    public function testCreatePlugin(): void
    {
        $config = [
            'headers' => [
                'x-foo' => 'bar',
            ],
        ];
        $factory = new HeaderAppendFactory();
        $plugin = $factory->createPlugin($config);

        $this->assertInstanceOf(HeaderAppendPlugin::class, $plugin);
    }
}
