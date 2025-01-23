<?php

declare(strict_types=1);

namespace TMV\HTTPlugModuleTest\PluginFactory\Authentication;

use Http\Message\Authentication;
use PHPUnit\Framework\TestCase;
use TMV\HTTPlugModule\PluginFactory\Authentication\QueryParamFactory;
use Prophecy\PhpUnit\ProphecyTrait;

class QueryParamFactoryTest extends TestCase
{
    use ProphecyTrait;

    public function testCreateAuthentication(): void
    {
        $config = [
            'parameters' => [
                'foo' => 'bar',
            ],
        ];

        $factory = new QueryParamFactory();

        $auth = $factory->createAuthentication($config);

        $this->assertInstanceOf(Authentication\QueryParam::class, $auth);
    }
}
