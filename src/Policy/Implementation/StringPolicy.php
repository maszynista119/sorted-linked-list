<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Policy\Implementation;

use M119\SortedLinkedList\Comparator\ComparatorInterface;
use M119\SortedLinkedList\Comparator\Implementation\StringComparator;
use M119\SortedLinkedList\Guard\Implementation\StringGuard;
use M119\SortedLinkedList\Guard\ValueGuardInterface;
use M119\SortedLinkedList\Policy\SortPolicyInterface;

final class StringPolicy implements SortPolicyInterface
{
    public function __construct(
        private readonly ComparatorInterface $comparator = new StringComparator(),
        private readonly ValueGuardInterface $guard = new StringGuard(),
    ) {
    }

    public function comparator(): ComparatorInterface
    {
        return $this->comparator;
    }
    public function guard(): ValueGuardInterface
    {
        return $this->guard;
    }
}
