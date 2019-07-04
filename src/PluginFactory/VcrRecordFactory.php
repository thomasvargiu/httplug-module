<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Common\Plugin;
use Http\Client\Plugin\Vcr\RecordPlugin;
use LogicException;

class VcrRecordFactory extends AbstractVcrFactory
{
    public function createPlugin(array $config = []): Plugin
    {
        if (! class_exists(RecordPlugin::class)) {
            throw new LogicException('To use the vcr record plugin you need to install the "php-http/vcr-plugin" package.');
        }

        $recorder = $this->getRecorder($config['recorder'] ?? 'filesystem', $config);
        $namingStrategy = $this->getNamingStrategy($config['naming_strategy'] ?? 'default', $config);

        return new RecordPlugin($namingStrategy, $recorder);
    }
}
