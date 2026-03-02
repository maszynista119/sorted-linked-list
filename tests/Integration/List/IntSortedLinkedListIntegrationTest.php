<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Tests\Integration\List;

use M119\SortedLinkedList\Factory\SortedLinkedListFactory;
use M119\SortedLinkedList\Exception\InvalidValueTypeException;
use M119\SortedLinkedList\List\SortedLinkedListInterface;
use PHPUnit\Framework\TestCase;

final class IntSortedLinkedListIntegrationTest extends TestCase
{
    private SortedLinkedListInterface $list;

    protected function setUp(): void
    {
        $factory = SortedLinkedListFactory::init();
        $this->list = $factory->int();
    }

    public function testInsertKeepsOrderAndToArray(): void
    {
        $this->assertTrue($this->list->isEmpty());

        $this->list->insert(3);
        $this->list->insert(1);
        $this->list->insert(2);

        $this->assertFalse($this->list->isEmpty());
        $this->assertSame(3, $this->list->count());

        $this->assertSame([1, 2, 3], $this->list->toArray());

        $iterValues = [];
        foreach ($this->list as $v) {
            $iterValues[] = $v;
        }
        $this->assertSame([1, 2, 3], $iterValues);
    }

    public function testRemoveAndClear(): void
    {
        $this->list->insert(10);
        $this->list->insert(5);
        $this->list->insert(7);

        $this->assertSame([5, 7, 10], $this->list->toArray());

        $this->assertTrue($this->list->remove(7));
        $this->assertSame([5, 10], $this->list->toArray());

        $this->assertFalse($this->list->remove(999));

        $this->list->clear();
        $this->assertTrue($this->list->isEmpty());
    }

    public function testGuardPreventsWrongTypesOnInsertAndRemove(): void
    {
        $this->expectException(InvalidValueTypeException::class);
        $this->list->insert('not-an-int');
    }
}
