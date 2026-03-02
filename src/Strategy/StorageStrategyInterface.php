<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Strategy;

use Traversable;

interface StorageStrategyInterface
{
    public function insert(mixed $value): void;
    public function remove(mixed $value): bool;

    public function isEmpty(): bool;
    public function clear(): void;
    public function count(): int;

    /**
     * @return Traversable<int, mixed>
     */
    public function iterate(): Traversable;

    /**
     * Convenience
     *
     * @return array<int, mixed>
     */
    public function toArray(): array;
}
