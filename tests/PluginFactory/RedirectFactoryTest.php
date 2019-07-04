<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\RedirectPlugin;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\PluginFactory\RedirectFactory;

class RedirectFactoryTest extends TestCase
{

    public function testCreatePlugin(): void
    {
        $config = [

        ];

        $factory = new RedirectFactory();
        $plugin = $factory->createPlugin($config);

        $this->assertInstanceOf(RedirectPlugin::class, $plugin);
    }
}
