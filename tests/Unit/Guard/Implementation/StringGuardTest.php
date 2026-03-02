<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Tests\Unit\Guard\Implementation;

use M119\SortedLinkedList\Exception\InvalidValueTypeException;
use M119\SortedLinkedList\Guard\Implementation\StringGuard;
use PHPUnit\Framework\TestCase;

final class StringGuardTest extends TestCase
{
    private StringGuard $guard;

    protected function setUp(): void
    {
        $this->guard = new StringGuard();
    }

    public function testAssertAcceptsString(): void
    {
        $this->guard->assert('abc');
        $this->assertTrue(true); // no exception thrown
    }

    public function testAssertThrowsOnNonString(): void
    {
        $this->expectException(InvalidValueTypeException::class);
        $this->guard->assert(123);
    }
}
