<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Strategy\Implementation;

use Ds\Deque;
use M119\SortedLinkedList\Comparator\ComparatorInterface;
use M119\SortedLinkedList\Strategy\StorageStrategyInterface;
use Traversable;

final class DequeStrategy implements StorageStrategyInterface
{
    private Deque $deque;

    public function __construct(
        private readonly ComparatorInterface $comparator
    ) {
        $this->deque = new Deque();
    }

    public function insert(mixed $value): void
    {
        if ($this->deque->isEmpty()) {
            $this->deque->push($value);
            return;
        }

        $idx = $this->upperBound($value);
        $this->deque->insert($idx, $value);
    }

    public function remove(mixed $value): bool
    {
        $n = $this->deque->count();
        if ($n === 0) {
            return false;
        }

        $idx = $this->lowerBound($value);

        if ($idx >= $n) {
            return false;
        }

        if ($this->comparator->compare($this->deque->get($idx), $value) !== 0) {
            return false;
        }

        $this->deque->remove($idx);
        return true;
    }

    public function isEmpty(): bool
    {
        return $this->deque->isEmpty();
    }

    public function clear(): void
    {
        $this->deque->clear();
    }

    public function count(): int
    {
        return $this->deque->count();
    }

    /**
     * @return Traversable<int, mixed>
     */
    public function iterate(): Traversable
    {
        $n = $this->deque->count();

        for ($i = 0; $i < $n; $i++) {
            yield $this->deque->get($i);
        }
    }

    /**
     * @return array<int, mixed>
     */
    public function toArray(): array
    {
        return $this->deque->toArray();
    }

    /** First index i where element >= value */
    private function lowerBound(mixed $value): int
    {
        $lo = 0;
        $hi = $this->deque->count();

        while ($lo < $hi) {
            $mid = $lo + intdiv($hi - $lo, 2);
            $cmp = $this->comparator->compare($this->deque->get($mid), $value);

            if ($cmp < 0) {
                $lo = $mid + 1;
            } else {
                $hi = $mid;
            }
        }

        return $lo;
    }

    /** First index i where element > value */
    private function upperBound(mixed $value): int
    {
        $lo = 0;
        $hi = $this->deque->count();

        while ($lo < $hi) {
            $mid = $lo + intdiv($hi - $lo, 2);
            $cmp = $this->comparator->compare($this->deque->get($mid), $value);

            if ($cmp <= 0) {
                $lo = $mid + 1;
            } else {
                $hi = $mid;
            }
        }

        return $lo;
    }
}
