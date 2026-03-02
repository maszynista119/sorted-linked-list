<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Tests\Unit\List;

use ArrayIterator;
use M119\SortedLinkedList\Guard\ValueGuardInterface;
use M119\SortedLinkedList\List\SortedLinkedList;
use M119\SortedLinkedList\Policy\SortPolicyInterface;
use M119\SortedLinkedList\Strategy\StorageStrategyInterface;
use PHPUnit\Framework\TestCase;

final class SortedLinkedListTest extends TestCase
{
    public function testInsertCallsGuardAndStrategy(): void
    {
        $value = 42;

        $guard = $this->createMock(ValueGuardInterface::class);
        $guard->expects($this->once())->method('assert')->with($value);

        $policy = $this->createMock(SortPolicyInterface::class);
        $policy->method('guard')->willReturn($guard);

        $strategy = $this->createMock(StorageStrategyInterface::class);
        $strategy->expects($this->once())->method('insert')->with($value);

        $list = new SortedLinkedList($strategy, $policy);
        $list->insert($value);
    }

    public function testRemoveDelegatesToGuardAndStrategy(): void
    {
        $value = 5;

        $guard = $this->createMock(ValueGuardInterface::class);
        $guard->expects($this->once())->method('assert')->with($value);

        $policy = $this->createMock(SortPolicyInterface::class);
        $policy->method('guard')->willReturn($guard);

        $strategy = $this->createMock(StorageStrategyInterface::class);
        $strategy->expects($this->once())->method('remove')->with($value)->willReturn(true);

        $list = new SortedLinkedList($strategy, $policy);
        $this->assertTrue($list->remove($value));
    }

    public function testGetIteratorAndToArrayDelegateToStrategy(): void
    {
        $data = [1, 2, 3];

        $guard = $this->createMock(ValueGuardInterface::class);
        $policy = $this->createMock(SortPolicyInterface::class);
        $policy->method('guard')->willReturn($guard);

        $strategy = $this->createMock(StorageStrategyInterface::class);
        $strategy->method('toArray')->willReturn($data);
        $strategy->method('iterate')->willReturn(new ArrayIterator($data));

        $list = new SortedLinkedList($strategy, $policy);

        $this->assertSame($data, $list->toArray());

        $iter = [];
        foreach ($list as $v) {
            $iter[] = $v;
        }
        $this->assertSame($data, $iter);
    }
}
