<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\RedirectPlugin;

class RedirectFactory implements PluginFactory
{
    public function createPlugin(array $config = []): Plugin
    {
        return new RedirectPlugin($config);
    }
}
