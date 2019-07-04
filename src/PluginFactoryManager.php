<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule;

use function array_key_exists;
use InvalidArgumentException;
use TMV\HTTPlugModule\PluginFactory\PluginFactory;

class PluginFactoryManager
{
    /** @var array<string, PluginFactory> */
    private $factories;

    /**
     * @param array<string, PluginFactory> $factories
     */
    public function __construct(array $factories = [])
    {
        foreach ($factories as $alias => $factory) {
            $this->add($alias, $factory);
        }
    }

    public function add(string $alias, PluginFactory $factory): void
    {
        $this->factories[$alias] = $factory;
    }

    public function has(string $alias): bool
    {
        return array_key_exists($alias, $this->factories);
    }

    /**
     * @return array<string, PluginFactory>
     */
    public function all(): array
    {
        return $this->factories;
    }

    public function getFactory(string $alias): PluginFactory
    {
        $factory = $this->factories[$alias] ?? null;

        if (! $factory) {
            throw new InvalidArgumentException('Unable to find a plugin factory for alias ' . $alias);
        }

        return $factory;
    }
}
