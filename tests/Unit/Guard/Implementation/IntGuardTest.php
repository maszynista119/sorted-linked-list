<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Tests\Unit\Guard\Implementation;

use M119\SortedLinkedList\Exception\InvalidValueTypeException;
use M119\SortedLinkedList\Guard\Implementation\IntGuard;
use PHPUnit\Framework\TestCase;

final class IntGuardTest extends TestCase
{
    private IntGuard $guard;

    protected function setUp(): void
    {
        $this->guard = new IntGuard();
    }

    public function testAssertAcceptsInt(): void
    {
        $this->guard->assert(5);
        $this->assertTrue(true); // no exception thrown
    }

    public function testAssertThrowsOnNonInt(): void
    {
        $this->expectException(InvalidValueTypeException::class);
        $this->guard->assert('not-int');
    }
}
