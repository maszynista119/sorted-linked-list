<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Comparator\Implementation;

use M119\SortedLinkedList\Comparator\ComparatorInterface;
use M119\SortedLinkedList\Exception\InvalidValueTypeException;

final class StringComparator implements ComparatorInterface
{
    public function compare(mixed $a, mixed $b): int
    {
        if (!is_string($a) || !is_string($b)) {
            throw new InvalidValueTypeException(
                'StringComparator expects string values. Got ' . gettype($a) . " and " . gettype($b)
            );
        }
        return strcmp($a, $b);
    }
}
