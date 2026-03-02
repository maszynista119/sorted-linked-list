<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Tests\Unit\Comparator;

use M119\SortedLinkedList\Comparator\Implementation\StringComparator;
use M119\SortedLinkedList\Exception\InvalidValueTypeException;
use PHPUnit\Framework\TestCase;

final class StringComparatorTest extends TestCase
{
    private StringComparator $cmp;

    protected function setUp(): void
    {
        $this->cmp = new StringComparator();
    }

    public function testCompareReturnsNegativeWhenFirstLessThanSecond(): void
    {
        $this->assertLessThan(0, $this->cmp->compare('a', 'b'));
    }

    public function testCompareReturnsZeroWhenEqual(): void
    {
        $this->assertSame(0, $this->cmp->compare('foo', 'foo'));
    }

    public function testCompareReturnsPositiveWhenFirstGreaterThanSecond(): void
    {
        $this->assertGreaterThan(0, $this->cmp->compare('z', 'a'));
    }

    public function testThrowsOnNonStringValues(): void
    {
        $this->expectException(InvalidValueTypeException::class);
        $this->cmp->compare(123, 'abc');
    }
}
