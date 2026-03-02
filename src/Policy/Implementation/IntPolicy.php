<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Policy\Implementation;

use M119\SortedLinkedList\Comparator\ComparatorInterface;
use M119\SortedLinkedList\Comparator\Implementation\IntComparator;
use M119\SortedLinkedList\Guard\Implementation\IntGuard;
use M119\SortedLinkedList\Guard\ValueGuardInterface;
use M119\SortedLinkedList\Policy\SortPolicyInterface;

final class IntPolicy implements SortPolicyInterface
{
    public function __construct(
        private readonly ComparatorInterface $comparator = new IntComparator(),
        private readonly ValueGuardInterface $guard = new IntGuard(),
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
