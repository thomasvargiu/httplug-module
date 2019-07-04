<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\RetryPlugin;

class RetryFactory implements PluginFactory
{
    public function createPlugin(array $config = []): Plugin
    {
        return new RetryPlugin($config);
    }
}
