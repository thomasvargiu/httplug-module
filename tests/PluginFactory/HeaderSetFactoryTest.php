<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\HeaderSetPlugin;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\PluginFactory\HeaderSetFactory;

class HeaderSetFactoryTest extends TestCase
{
    public function testCreatePlugin(): void
    {
        $config = [
            'headers' => [
                'x-foo' => 'bar',
            ],
        ];
        $factory = new HeaderSetFactory();
        $plugin = $factory->createPlugin($config);

        $this->assertInstanceOf(HeaderSetPlugin::class, $plugin);
    }
}
