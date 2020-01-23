<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\PluginFactory;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\HistoryPlugin;
use Http\Client\Common\Plugin\Journal;
use InvalidArgumentException;
use Psr\Container\ContainerInterface;

class HistoryFactory implements PluginFactory
{
    /** @var ContainerInterface */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param array<string, mixed> $config
     *
     * @return Plugin
     */
    public function createPlugin(array $config = []): Plugin
    {
        $journalServiceName = $config['journal'] ?? null;

        if (! \is_string($journalServiceName)) {
            throw new InvalidArgumentException('Invalid "journal" parameter');
        }

        $journal = $this->container->get($journalServiceName);

        if (! $journal instanceof Journal) {
            throw new InvalidArgumentException('Invalid "journal" service');
        }

        return new HistoryPlugin($journal);
    }
}
