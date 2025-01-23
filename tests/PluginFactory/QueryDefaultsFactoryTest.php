<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\QueryDefaultsPlugin;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\PluginFactory\QueryDefaultsFactory;
use Prophecy\PhpUnit\ProphecyTrait;

class QueryDefaultsFactoryTest extends TestCase
{
    use ProphecyTrait;

    public function testCreatePlugin(): void
    {
        $config = [
            'parameters' => [],
        ];

        $factory = new QueryDefaultsFactory();
        $plugin = $factory->createPlugin($config);

        $this->assertInstanceOf(QueryDefaultsPlugin::class, $plugin);
    }
}
