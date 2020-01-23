<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\CookiePlugin;
use Http\Message\CookieJar;
use InvalidArgumentException;
use Psr\Container\ContainerInterface;

class CookieFactory implements PluginFactory
{
    /** @var ContainerInterface */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param array<string, mixed> $config
     *
     * @return Plugin
     */
    public function createPlugin(array $config = []): Plugin
    {
        $cookieJarName = $config['cookie_jar'] ?? null;

        if (! \is_string($cookieJarName)) {
            throw new InvalidArgumentException('Invalid "cookie_jar" parameter');
        }

        $cookieJar = $this->container->get($cookieJarName);

        if (! $cookieJar instanceof CookieJar) {
            throw new InvalidArgumentException('Invalid "cookie_jar" service');
        }

        return new CookiePlugin($cookieJar);
    }
}
