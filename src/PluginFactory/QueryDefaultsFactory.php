<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\QueryDefaultsPlugin;

class QueryDefaultsFactory implements PluginFactory
{
    /**
     * @param array<string, mixed> $config
     *
     * @return Plugin
     */
    public function createPlugin(array $config = []): Plugin
    {
        return new QueryDefaultsPlugin($config['parameters'] ?? []);
    }
}
