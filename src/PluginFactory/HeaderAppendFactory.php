<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\HeaderAppendPlugin;

class HeaderAppendFactory implements PluginFactory
{
    public function createPlugin(array $config = []): Plugin
    {
        return new HeaderAppendPlugin($config['headers'] ?? []);
    }
}
