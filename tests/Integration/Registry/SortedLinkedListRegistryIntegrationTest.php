<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Tests\Integration\Registry;

use M119\SortedLinkedList\Factory\Enum\ElementType;
use M119\SortedLinkedList\Factory\Enum\StorageStrategyType;
use M119\SortedLinkedList\Registry\SortedLinkedListRegistry;
use M119\SortedLinkedList\Policy\Implementation\IntPolicy;
use M119\SortedLinkedList\Strategy\Implementation\DequeStrategy;
use PHPUnit\Framework\TestCase;

final class SortedLinkedListRegistryIntegrationTest extends TestCase
{
    public function testDefaultRegistryProvidesPoliciesAndStrategies(): void
    {
        $registry = SortedLinkedListRegistry::default();

        $policies = $registry->listPolicies();
        $this->assertContains(ElementType::INT->value, $policies);
        $this->assertContains(ElementType::STRING->value, $policies);

        $strategies = $registry->listStrategies();
        $this->assertContains(StorageStrategyType::DEQUE->value, $strategies);
    }

    public function testCreatePolicyAndStrategyInstances(): void
    {
        $registry = SortedLinkedListRegistry::default();

        $policy = $registry->createPolicy(ElementType::INT->value);
        $this->assertInstanceOf(IntPolicy::class, $policy);

        $strategy = $registry->createStrategy(StorageStrategyType::DEQUE->value, $policy->comparator());
        $this->assertInstanceOf(DequeStrategy::class, $strategy);
    }
}
