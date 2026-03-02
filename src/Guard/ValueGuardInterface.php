<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Guard;

interface ValueGuardInterface
{
    public function assert(mixed $value): void;
}
