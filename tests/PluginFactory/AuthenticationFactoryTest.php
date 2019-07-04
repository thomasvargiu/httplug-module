<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory;

use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Message\Authentication;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\PluginFactory\Authentication\AuthenticationFactory as AuthFactory;
use TMV\HTTPlugModule\PluginFactory\AuthenticationFactory;

class AuthenticationFactoryTest extends TestCase
{
    public function testCreatePlugin(): void
    {
        $config = [
            'type' => 'foo',
            'options' => [
                'foo' => 'bar',
            ],
        ];

        $auth = $this->prophesize(Authentication::class);
        $authFactory = $this->prophesize(AuthFactory::class);
        $authFactory->createAuthentication($config['options'])
            ->shouldBeCalled()
            ->willReturn($auth->reveal());

        $factory = new AuthenticationFactory([
            'foo' => $authFactory->reveal(),
        ]);

        $plugin = $factory->createPlugin($config);

        $this->assertInstanceOf(AuthenticationPlugin::class, $plugin);
    }
}
