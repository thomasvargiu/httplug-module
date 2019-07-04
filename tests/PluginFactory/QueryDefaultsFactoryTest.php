<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\QueryDefaultsPlugin;
use TMV\HTTPlugModule\PluginFactory\QueryDefaultsFactory;
use PHPUnit\Framework\TestCase;

class QueryDefaultsFactoryTest extends TestCase
{

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
