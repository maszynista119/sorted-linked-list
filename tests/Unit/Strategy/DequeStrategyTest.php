<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Tests\Unit\Strategy;

use M119\SortedLinkedList\Comparator\ComparatorInterface;
use M119\SortedLinkedList\Strategy\Implementation\DequeStrategy;
use PHPUnit\Framework\TestCase;

final class DequeStrategyTest extends TestCase
{
    public function testInsertAndIterateMaintainSortedOrder(): void
    {
        // mock comparator to use natural integer ordering
        $cmp = $this->createMock(ComparatorInterface::class);
        $cmp->method('compare')->willReturnCallback(fn($a, $b) => $a <=> $b);

        $strategy = new DequeStrategy($cmp);

        $strategy->insert(3);
        $strategy->insert(1);
        $strategy->insert(2);

        $this->assertSame(3, $strategy->count());

        $arr = $strategy->toArray();
        $this->assertSame([1,2,3], $arr);

        $iterated = [];
        foreach ($strategy->iterate() as $v) {
            $iterated[] = $v;
        }
        $this->assertSame([1,2,3], $iterated);
    }

    public function testRemoveWorks(): void
    {
        $cmp = $this->createMock(ComparatorInterface::class);
        $cmp->method('compare')->willReturnCallback(fn($a, $b) => $a <=> $b);

        $strategy = new DequeStrategy($cmp);

        $strategy->insert(1);
        $strategy->insert(2);
        $strategy->insert(3);

        $this->assertTrue($strategy->remove(2));
        $this->assertFalse($strategy->remove(999));
        $this->assertSame([1,3], $strategy->toArray());
    }
}
