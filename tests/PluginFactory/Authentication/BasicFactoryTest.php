<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory\Authentication;

use Http\Message\Authentication;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\PluginFactory\Authentication\BasicFactory;
use Prophecy\PhpUnit\ProphecyTrait;

class BasicFactoryTest extends TestCase
{
    use ProphecyTrait;
    public function testCreateAuthentication(): void
    {
        $config = [
            'username' => 'foo',
            'password' => 'bar',
        ];

        $factory = new BasicFactory();

        $auth = $factory->createAuthentication($config);

        $this->assertInstanceOf(Authentication\BasicAuth::class, $auth);
    }
}
