<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\List;

use M119\SortedLinkedList\Policy\SortPolicyInterface;
use M119\SortedLinkedList\Strategy\StorageStrategyInterface;
use Traversable;

class SortedLinkedList implements SortedLinkedListInterface
{
    public function __construct(
        private readonly StorageStrategyInterface $strategy,
        private readonly SortPolicyInterface $policy,
    ) {
    }

    public function insert(mixed $value): void
    {
        $this->policy->guard()->assert($value);
        $this->strategy->insert($value);
    }
    public function remove(mixed $value): bool
    {
        $this->policy->guard()->assert($value);
        return $this->strategy->remove($value);
    }

    /**
     * @return array<int, mixed>
     */
    public function toArray(): array
    {
        return $this->strategy->toArray();
    }

    public function isEmpty(): bool
    {
        return $this->strategy->isEmpty();
    }

    public function clear(): void
    {
        $this->strategy->clear();
    }

    /**
     * @return Traversable<int, mixed>
     */
    public function getIterator(): Traversable
    {
        return $this->strategy->iterate();
    }

    public function count(): int
    {
        return $this->strategy->count();
    }

    public function __toString(): string
    {
        return implode(', ', array_map(
            static fn($v) => is_scalar($v) ? (string)$v : json_encode($v),
            $this->toArray()
        ));
    }

    public function policy(): SortPolicyInterface
    {
        return $this->policy;
    }
}
