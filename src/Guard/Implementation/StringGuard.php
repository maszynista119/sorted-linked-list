<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Guard\Implementation;

use M119\SortedLinkedList\Exception\InvalidValueTypeException;
use M119\SortedLinkedList\Guard\ValueGuardInterface;

final class StringGuard implements ValueGuardInterface
{
    public function assert(mixed $value): void
    {
        if (!is_string($value)) {
            throw new InvalidValueTypeException('Expected string. Got ' . gettype($value));
        }
    }
}
