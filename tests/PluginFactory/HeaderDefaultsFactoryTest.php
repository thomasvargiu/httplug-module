<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\PluginFactory\HeaderDefaultsFactory;
use Prophecy\PhpUnit\ProphecyTrait;

class HeaderDefaultsFactoryTest extends TestCase
{
    use ProphecyTrait;
    public function testCreatePlugin(): void
    {
        $config = [
            'headers' => [
                'x-foo' => 'bar',
            ],
        ];
        $factory = new HeaderDefaultsFactory();
        $plugin = $factory->createPlugin($config);

        $this->assertInstanceOf(HeaderDefaultsPlugin::class, $plugin);
    }
}
