<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Tests\Unit\Factory;

use M119\SortedLinkedList\Comparator\ComparatorInterface;
use M119\SortedLinkedList\Factory\SortedLinkedListFactory;
use M119\SortedLinkedList\List\SortedLinkedListInterface;
use M119\SortedLinkedList\Policy\SortPolicyInterface;
use M119\SortedLinkedList\Registry\SortedLinkedListRegistry;
use M119\SortedLinkedList\Strategy\StorageStrategyInterface;
use PHPUnit\Framework\TestCase;

final class SortedLinkedListFactoryTest extends TestCase
{
    public function testCreateByKeyUsesRegistryAndReturnsList(): void
    {
        $registry = new SortedLinkedListRegistry();
        $factory = new SortedLinkedListFactory($registry);

        $policyKey = 'int';
        $strategyKey = 'deque';

        $policy = $this->createMock(SortPolicyInterface::class);
        $comparator = $this->createMock(ComparatorInterface::class);
        $policy->method('comparator')->willReturn($comparator);

        $storage = $this->createMock(StorageStrategyInterface::class);

        // register factories on the real registry to return our mocks
        $registry->registerPolicy($policyKey, fn() => $policy);
        $registry->registerStrategy($strategyKey, fn($c) => $storage);

        $list = $factory->createByKey($policyKey, $strategyKey);
        $this->assertInstanceOf(SortedLinkedListInterface::class, $list);
    }
}
