<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Tests\Unit\Registry;

use M119\SortedLinkedList\Comparator\ComparatorInterface;
use M119\SortedLinkedList\Exception\UnknownPolicyException;
use M119\SortedLinkedList\Exception\UnknownStrategyException;
use M119\SortedLinkedList\Policy\SortPolicyInterface;
use M119\SortedLinkedList\Registry\SortedLinkedListRegistry;
use M119\SortedLinkedList\Strategy\StorageStrategyInterface;
use PHPUnit\Framework\TestCase;

final class SortedLinkedListRegistryTest extends TestCase
{
    public function testRegisterAndHasAndListPoliciesAndStrategies(): void
    {
        $registry = new SortedLinkedListRegistry();

        $registry->registerPolicy('p1', fn(): SortPolicyInterface => $this->createMock(SortPolicyInterface::class));
        $registry->registerPolicy('p2', fn(): SortPolicyInterface => $this->createMock(SortPolicyInterface::class));

        $this->assertTrue($registry->hasPolicy('p1'));
        $this->assertTrue($registry->hasPolicy('p2'));

        $policies = $registry->listPolicies();
        $this->assertContains('p1', $policies);
        $this->assertContains('p2', $policies);

        $registry->registerStrategy(
            's1',
            fn(SortPolicyInterface $p): StorageStrategyInterface
                => $this->createMock(StorageStrategyInterface::class)
        );
        $this->assertTrue($registry->hasStrategy('s1'));

        $strategies = $registry->listStrategies();
        $this->assertContains('s1', $strategies);
    }

    public function testCreatePolicyAndStrategyUseFactories(): void
    {
        $registry = new SortedLinkedListRegistry();

        $registry->registerPolicy('p', fn(): SortPolicyInterface => $this->createMock(SortPolicyInterface::class));
        $policy = $registry->createPolicy('p');
        $this->assertInstanceOf(SortPolicyInterface::class, $policy);

        $registry->registerStrategy(
            's',
            fn(ComparatorInterface $c): StorageStrategyInterface
                => $this->createMock(StorageStrategyInterface::class)
        );
        $strategy = $registry->createStrategy('s', $this->createMock(ComparatorInterface::class));
        $this->assertInstanceOf(StorageStrategyInterface::class, $strategy);
    }

    public function testUnknownPolicyThrows(): void
    {
        $this->expectException(UnknownPolicyException::class);
        $registry = new SortedLinkedListRegistry();
        $registry->createPolicy('does-not-exist');
    }

    public function testUnknownStrategyThrows(): void
    {
        $this->expectException(UnknownStrategyException::class);
        $registry = new SortedLinkedListRegistry();
        $registry->createStrategy('nope', $this->createMock(ComparatorInterface::class));
    }
}
