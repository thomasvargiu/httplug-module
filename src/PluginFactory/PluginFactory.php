<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Common\Plugin;

interface PluginFactory
{
    public function createPlugin(array $config = []): Plugin;
}
