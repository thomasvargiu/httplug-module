<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\DecoderPlugin;

class DecoderFactory implements PluginFactory
{
    public function createPlugin(array $config = []): Plugin
    {
        return new DecoderPlugin($config);
    }
}
