<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Registry;

use M119\SortedLinkedList\Comparator\ComparatorInterface;
use M119\SortedLinkedList\Exception\InvalidPolicyException;
use M119\SortedLinkedList\Exception\InvalidStrategyException;
use M119\SortedLinkedList\Exception\UnknownPolicyException;
use M119\SortedLinkedList\Exception\UnknownStrategyException;
use M119\SortedLinkedList\Factory\Enum\ElementType;
use M119\SortedLinkedList\Factory\Enum\StorageStrategyType;
use M119\SortedLinkedList\Policy\Implementation\IntPolicy;
use M119\SortedLinkedList\Policy\Implementation\StringPolicy;
use M119\SortedLinkedList\Policy\SortPolicyInterface;
use M119\SortedLinkedList\Strategy\Implementation\DequeStrategy;
use M119\SortedLinkedList\Strategy\StorageStrategyInterface;

class SortedLinkedListRegistry
{
    /** @var array<string, callable(): SortPolicyInterface> */
    private array $policies = [];

    /** @var array<string, callable(\M119\SortedLinkedList\Comparator\ComparatorInterface): StorageStrategyInterface> */
    private array $strategies = [];

    public static function default(): self
    {
        $r = new self();

        $r->registerPolicy(ElementType::INT->value, fn() => new IntPolicy());
        $r->registerPolicy(ElementType::STRING->value, fn() => new StringPolicy());
        $r->registerStrategy(
            StorageStrategyType::DEQUE->value,
            fn(ComparatorInterface $c) => new DequeStrategy($c)
        );

        return $r;
    }

    public function registerPolicy(string $key, callable $factory): self
    {
        $this->policies[$key] = $factory;
        return $this;
    }

    public function registerStrategy(string $key, callable $factory): self
    {
        $this->strategies[$key] = $factory;
        return $this;
    }

    public function hasPolicy(string $key): bool
    {
        return isset($this->policies[$key]);
    }
    public function hasStrategy(string $key): bool
    {
        return isset($this->strategies[$key]);
    }

    /** @return string[] */
    public function listPolicies(): array
    {
        $keys = array_keys($this->policies);
        sort($keys);
        return $keys;
    }

    /** @return string[] */
    public function listStrategies(): array
    {
        $keys = array_keys($this->strategies);
        sort($keys);
        return $keys;
    }

    public function createPolicy(string $key): SortPolicyInterface
    {
        $factory = $this->policies[$key] ?? null;
        if ($factory === null) {
            throw new UnknownPolicyException("Unknown policy: {$key}");
        }

        $policy = $factory();
        if (!$policy instanceof SortPolicyInterface) {
            throw new InvalidPolicyException("Policy factory '{$key}' did not return SortPolicyInterface");
        }

        return $policy;
    }

    public function createStrategy(string $key, ComparatorInterface $comparator): StorageStrategyInterface
    {
        $factory = $this->strategies[$key] ?? null;
        if ($factory === null) {
            throw new UnknownStrategyException("Unknown strategy: {$key}");
        }

        $strategy = $factory($comparator);
        if (!$strategy instanceof StorageStrategyInterface) {
            throw new InvalidStrategyException("Strategy factory '{$key}' did not return StorageStrategyInterface");
        }

        return $strategy;
    }
}
