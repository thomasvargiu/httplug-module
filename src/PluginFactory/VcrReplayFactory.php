<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Common\Plugin;
use Http\Client\Plugin\Vcr\ReplayPlugin;
use LogicException;

class VcrReplayFactory extends AbstractVcrFactory
{
    /**
     * @param array<string, mixed> $config
     */
    public function createPlugin(array $config = []): Plugin
    {
        if (! class_exists(ReplayPlugin::class)) {
            throw new LogicException('To use the vcr replay plugin you need to install the "php-http/vcr-plugin" package.');
        }

        $player = $this->getPlayer($config['player'] ?? 'filesystem', $config);
        $namingStrategy = $this->getNamingStrategy($config['naming_strategy'] ?? 'default', $config);

        return new ReplayPlugin($namingStrategy, $player, $config['throw'] ?? true);
    }
}
