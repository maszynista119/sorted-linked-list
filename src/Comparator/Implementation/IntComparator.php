<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Comparator\Implementation;

use M119\SortedLinkedList\Comparator\ComparatorInterface;
use M119\SortedLinkedList\Exception\InvalidValueTypeException;

final class IntComparator implements ComparatorInterface
{
    public function compare(mixed $a, mixed $b): int
    {
        if (!is_int($a) || !is_int($b)) {
            throw new InvalidValueTypeException(
                'IntComparator expects int values. Got ' . gettype($a) . " and " . gettype($b)
            );
        }
        return $a <=> $b;
    }
}
