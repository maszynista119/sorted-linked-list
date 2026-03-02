<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Tests\Unit\Comparator;

use M119\SortedLinkedList\Comparator\Implementation\IntComparator;
use M119\SortedLinkedList\Exception\InvalidValueTypeException;
use PHPUnit\Framework\TestCase;

final class IntComparatorTest extends TestCase
{
    private IntComparator $cmp;

    protected function setUp(): void
    {
        $this->cmp = new IntComparator();
    }

    public function testCompareReturnsNegativeWhenFirstLessThanSecond(): void
    {
        $this->assertLessThan(0, $this->cmp->compare(1, 2));
    }

    public function testCompareReturnsZeroWhenEqual(): void
    {
        $this->assertSame(0, $this->cmp->compare(5, 5));
    }

    public function testCompareReturnsPositiveWhenFirstGreaterThanSecond(): void
    {
        $this->assertGreaterThan(0, $this->cmp->compare(10, 2));
    }

    public function testThrowsOnNonIntValues(): void
    {
        $this->expectException(InvalidValueTypeException::class);
        $this->cmp->compare('not-int', 1);
    }
}
