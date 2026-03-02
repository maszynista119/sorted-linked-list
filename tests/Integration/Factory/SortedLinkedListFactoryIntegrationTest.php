<?php

declare(strict_types=1);

namespace M119\SortedLinkedList\Tests\Integration\Factory;

use M119\SortedLinkedList\Factory\SortedLinkedListFactory;
use M119\SortedLinkedList\List\SortedLinkedListInterface;
use PHPUnit\Framework\TestCase;

final class SortedLinkedListFactoryIntegrationTest extends TestCase
{
    public function testInitAndCreateReturnRealList(): void
    {
        $factory = SortedLinkedListFactory::init();
        $this->assertInstanceOf(SortedLinkedListFactory::class, $factory);
        $list = $factory->create();
        $this->assertInstanceOf(SortedLinkedListInterface::class, $list);
    }
}
