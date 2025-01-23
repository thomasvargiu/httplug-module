<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\RetryPlugin;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\PluginFactory\RetryFactory;
use Prophecy\PhpUnit\ProphecyTrait;

class RetryFactoryTest extends TestCase
{
    use ProphecyTrait;
    public function testCreatePlugin(): void
    {
        $config = [
        ];

        $factory = new RetryFactory();
        $plugin = $factory->createPlugin($config);

        $this->assertInstanceOf(RetryPlugin::class, $plugin);
    }
}
