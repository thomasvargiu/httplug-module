<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\RetryPlugin;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\PluginFactory\RetryFactory;

class RetryFactoryTest extends TestCase
{

    public function testCreatePlugin(): void
    {
        $config = [

        ];

        $factory = new RetryFactory();
        $plugin = $factory->createPlugin($config);

        $this->assertInstanceOf(RetryPlugin::class, $plugin);
    }
}
