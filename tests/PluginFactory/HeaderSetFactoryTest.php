<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\HeaderSetPlugin;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\PluginFactory\HeaderSetFactory;
use Prophecy\PhpUnit\ProphecyTrait;

class HeaderSetFactoryTest extends TestCase
{
    use ProphecyTrait;
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
