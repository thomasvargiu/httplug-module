<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\ContentLengthPlugin;

class ContentLengthFactory implements PluginFactory
{
    /**
     * @param array<string, mixed> $config
     */
    public function createPlugin(array $config = []): Plugin
    {
        return new ContentLengthPlugin();
    }
}
