<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory\Authentication;

use Http\Message\Authentication;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\PluginFactory\Authentication\BearerFactory;
use Prophecy\PhpUnit\ProphecyTrait;

class BearerFactoryTest extends TestCase
{
    use ProphecyTrait;
    public function testCreateAuthentication(): void
    {
        $config = [
            'token' => 'foo',
        ];

        $factory = new BearerFactory();

        $auth = $factory->createAuthentication($config);

        $this->assertInstanceOf(Authentication\Bearer::class, $auth);
    }
}
