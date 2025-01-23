<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Plugin\Vcr\NamingStrategy\NamingStrategyInterface;
use Http\Client\Plugin\Vcr\NamingStrategy\PathNamingStrategy;
use Http\Client\Plugin\Vcr\Recorder\FilesystemRecorder;
use Http\Client\Plugin\Vcr\Recorder\InMemoryRecorder;
use Http\Client\Plugin\Vcr\Recorder\PlayerInterface;
use Http\Client\Plugin\Vcr\Recorder\RecorderInterface;
use Psr\Container\ContainerInterface;

abstract class AbstractVcrFactory implements PluginFactory
{
    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param array<string, mixed> $config
     */
    protected function getRecorder(string $recorder, array $config = []): RecorderInterface
    {
        switch ($recorder) {
            case 'filesystem':
                return new FilesystemRecorder($config['fixtures_directory']);

            case 'in_memory':
                return new InMemoryRecorder();
        }

        return $this->container->get($recorder);
    }

    /**
     * @param array<string, mixed> $config
     */
    protected function getPlayer(string $recorder, array $config = []): PlayerInterface
    {
        switch ($recorder) {
            case 'filesystem':
                return new FilesystemRecorder($config['fixtures_directory']);

            case 'in_memory':
                return new InMemoryRecorder();
        }

        return $this->container->get($recorder);
    }

    /**
     * @param array<string, mixed> $config
     */
    protected function getNamingStrategy(string $namingStrategy, array $config = []): NamingStrategyInterface
    {
        if ($namingStrategy === 'default') {
            return new PathNamingStrategy($config['naming_strategy_options']);
        }

        return $this->container->get($namingStrategy);
    }
}
