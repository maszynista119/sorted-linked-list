<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Tests\Unit\Policy;

use M119\SortedLinkedList\Comparator\Implementation\IntComparator;
use M119\SortedLinkedList\Guard\Implementation\IntGuard;
use M119\SortedLinkedList\Policy\Implementation\IntPolicy;
use PHPUnit\Framework\TestCase;

final class IntPolicyTest extends TestCase
{
    public function testComparatorAndGuardAreProvided(): void
    {
        $policy = new IntPolicy();
        $this->assertInstanceOf(IntComparator::class, $policy->comparator());
        $this->assertInstanceOf(IntGuard::class, $policy->guard());
    }
}
