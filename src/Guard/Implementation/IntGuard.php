<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Guard\Implementation;

use M119\SortedLinkedList\Exception\InvalidValueTypeException;
use M119\SortedLinkedList\Guard\ValueGuardInterface;

final class IntGuard implements ValueGuardInterface
{
    public function assert(mixed $value): void
    {
        if (!is_int($value)) {
            throw new InvalidValueTypeException('Expected int. Got ' . gettype($value));
        }
    }
}
