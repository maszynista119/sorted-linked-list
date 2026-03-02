<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\List;

use Countable;
use IteratorAggregate;
use Stringable;
use Traversable;

interface SortedLinkedListInterface extends IteratorAggregate, Countable, Stringable
{
    public function insert(mixed $value): void;

    public function remove(mixed $value): bool;

    /**
     * @return array<int, mixed>
     */
    public function toArray(): array;
    public function isEmpty(): bool;
    public function clear(): void;

    /**
     * @return Traversable<int, mixed>
     */
    public function getIterator(): Traversable;
}
