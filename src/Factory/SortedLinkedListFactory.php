<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Factory;

use M119\SortedLinkedList\Factory\Enum\ElementType;
use M119\SortedLinkedList\Factory\Enum\StorageStrategyType;
use M119\SortedLinkedList\List\SortedLinkedList;
use M119\SortedLinkedList\List\SortedLinkedListInterface;
use M119\SortedLinkedList\Registry\SortedLinkedListRegistry;

final class SortedLinkedListFactory
{
    public function __construct(
        private readonly SortedLinkedListRegistry $registry
    ) {
    }

    public static function init(): self
    {
        return new self(SortedLinkedListRegistry::default());
    }

    public function create(
        ElementType $type = ElementType::INT,
        StorageStrategyType $strategy = StorageStrategyType::DEQUE
    ): SortedLinkedListInterface {
        return $this->createByKey($type->value, $strategy->value);
    }

    public function registry(): SortedLinkedListRegistry
    {
        return $this->registry;
    }

    public function int(): SortedLinkedListInterface
    {
        return $this->createByKey(ElementType::INT->value, StorageStrategyType::DEQUE->value);
    }

    public function string(): SortedLinkedListInterface
    {
        return $this->createByKey(ElementType::STRING->value, StorageStrategyType::DEQUE->value);
    }

    public function createByKey(string $policyKey, string $strategyKey): SortedLinkedListInterface
    {
        $policy = $this->registry->createPolicy($policyKey);
        $storage = $this->registry->createStrategy($strategyKey, $policy->comparator());
        return new SortedLinkedList($storage, $policy);
    }
}
