<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Policy;

use M119\SortedLinkedList\Comparator\ComparatorInterface;
use M119\SortedLinkedList\Guard\ValueGuardInterface;

interface SortPolicyInterface
{
    public function comparator(): ComparatorInterface;

    public function guard(): ValueGuardInterface;
}
