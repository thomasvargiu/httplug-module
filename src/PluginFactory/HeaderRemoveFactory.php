<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\HeaderRemovePlugin;

class HeaderRemoveFactory implements PluginFactory
{
    public function createPlugin(array $config = []): Plugin
    {
        return new HeaderRemovePlugin($config['headers'] ?? []);
    }
}
