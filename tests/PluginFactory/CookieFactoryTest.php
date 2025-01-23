<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\CookiePlugin;
use Http\Message\CookieJar;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use TMV\HTTPlugModule\PluginFactory\CookieFactory;
use Prophecy\PhpUnit\ProphecyTrait;

class CookieFactoryTest extends TestCase
{
    use ProphecyTrait;

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
