<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\ErrorPlugin;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\PluginFactory\ErrorFactory;
use Prophecy\PhpUnit\ProphecyTrait;

class ErrorFactoryTest extends TestCase
{
    use ProphecyTrait;
    public function testCreatePlugin(): void
    {
        $factory = new ErrorFactory();
        $plugin = $factory->createPlugin();

        $this->assertInstanceOf(ErrorPlugin::class, $plugin);
    }
}
