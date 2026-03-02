<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Comparator;

interface ComparatorInterface
{
    /** <0 if $a<$b, 0 if equal, >0 if $a>$b */
    public function compare(mixed $a, mixed $b): int;
}
