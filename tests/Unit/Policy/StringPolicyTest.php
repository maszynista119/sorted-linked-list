<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Tests\Unit\Policy;

use M119\SortedLinkedList\Comparator\Implementation\StringComparator;
use M119\SortedLinkedList\Guard\Implementation\StringGuard;
use M119\SortedLinkedList\Policy\Implementation\StringPolicy;
use PHPUnit\Framework\TestCase;

final class StringPolicyTest extends TestCase
{
    public function testComparatorAndGuardAreProvided(): void
    {
        $policy = new StringPolicy();
        $this->assertInstanceOf(StringComparator::class, $policy->comparator());
        $this->assertInstanceOf(StringGuard::class, $policy->guard());
    }
}
