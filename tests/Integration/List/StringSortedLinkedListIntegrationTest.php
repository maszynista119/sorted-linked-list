<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Tests\Integration\List;

use M119\SortedLinkedList\Factory\SortedLinkedListFactory;
use M119\SortedLinkedList\Exception\InvalidValueTypeException;
use M119\SortedLinkedList\List\SortedLinkedListInterface;
use PHPUnit\Framework\TestCase;

final class StringSortedLinkedListIntegrationTest extends TestCase
{
    private SortedLinkedListInterface $list;

    protected function setUp(): void
    {
        $factory = SortedLinkedListFactory::init();
        $this->list = $factory->string();
    }

    public function testInsertKeepsOrderAndToArray(): void
    {
        $this->assertTrue($this->list->isEmpty());

        $this->list->insert('c');
        $this->list->insert('a');
        $this->list->insert('b');

        $this->assertFalse($this->list->isEmpty());
        $this->assertSame(3, $this->list->count());

        $this->assertSame(['a', 'b', 'c'], $this->list->toArray());

        $iterValues = [];
        foreach ($this->list as $v) {
            $iterValues[] = $v;
        }
        $this->assertSame(['a', 'b', 'c'], $iterValues);
    }

    public function testRemoveAndClear(): void
    {
        $this->list->insert('j');
        $this->list->insert('e');
        $this->list->insert('g');

        $this->assertSame(['e', 'g', 'j'], $this->list->toArray());

        $this->assertTrue($this->list->remove('g'));
        $this->assertSame(['e', 'j'], $this->list->toArray());

        $this->assertFalse($this->list->remove('zzz'));

        $this->list->clear();
        $this->assertTrue($this->list->isEmpty());
    }

    public function testGuardPreventsWrongTypesOnInsertAndRemove(): void
    {
        $this->expectException(InvalidValueTypeException::class);
        $this->list->insert(123);
    }
}
