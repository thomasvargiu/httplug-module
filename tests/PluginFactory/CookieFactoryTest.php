<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\CookiePlugin;
use Http\Message\CookieJar;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\PluginFactory\CookieFactory;

class CookieFactoryTest extends TestCase
{
    public function testCreatePlugin(): void
    {
        $config = [
            'cookie_jar' => 'foo',
        ];

        $cookieJar = new CookieJar();
        $container = $this->prophesize(ContainerInterface::class);

        $container->get('foo')->willReturn($cookieJar);

        $factory = new CookieFactory($container->reveal());

        $plugin = $factory->createPlugin($config);

        $this->assertInstanceOf(CookiePlugin::class, $plugin);
    }
}
