<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\HeaderRemovePlugin;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\PluginFactory\HeaderRemoveFactory;

class HeaderRemoveFactoryTest extends TestCase
{
    public function testCreatePlugin(): void
    {
        $config = [
            'headers' => [
                'x-foo',
            ],
        ];
        $factory = new HeaderRemoveFactory();
        $plugin = $factory->createPlugin($config);

        $this->assertInstanceOf(HeaderRemovePlugin::class, $plugin);
    }
}
