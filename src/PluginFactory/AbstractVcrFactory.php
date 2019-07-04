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

    /** @var ContainerInterface */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    protected function getRecorder(string $recorder, array $config = []): RecorderInterface
    {
        switch ($recorder) {
            case 'filesystem':
                return  new FilesystemRecorder($config['fixtures_directory']);
                break;

            case 'in_memory':
                return new InMemoryRecorder();
                break;
        }

        return $this->container->get($recorder);
    }

    protected function getPlayer(string $recorder, array $config = []): PlayerInterface
    {
        switch ($recorder) {
            case 'filesystem':
                return  new FilesystemRecorder($config['fixtures_directory']);
                break;

            case 'in_memory':
                return new InMemoryRecorder();
                break;
        }

        return $this->container->get($recorder);
    }

    protected function getNamingStrategy(string $namingStrategy, array $config = []): NamingStrategyInterface
    {
        if ($namingStrategy === 'default') {
            return new PathNamingStrategy($config['naming_strategy_options']);
        }

        return $this->container->get($namingStrategy);
    }
}
