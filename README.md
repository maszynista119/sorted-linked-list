# sorted-linked-list
## Instalation
```
composer require maszynista119/sorted-linked-list
```

## Quick start
Library provides implemetation of sorted linked list.

Supported types:
- int
- string

Storage strategy:
- deque

Storage and types can be extended.

### Integer list

```php
use M119\SortedLinkedList\Factory\SortedLinkedListFactory;

$list = SortedLinkedListFactory::init()->int();
$list->insert(1);
$list->insert(2);
$list->insert(0);

echo $list; // 0, 1, 2
```

### String list
```php
use M119\SortedLinkedList\Factory\SortedLinkedListFactory;

$list = SortedLinkedListFactory::init()->string();
$list->insert("pear");
$list->insert("apple");

echo $list; // apple, pear
````

### Iteration and counting

```php
foreach ($list as $value) {
    echo $value;
}

count($list);
```
## Extending the library

### Custom policy

Policies define ordering and validation. You can use your own policy.
```php
final class UserAgePolicy implements SortPolicyInterface
{
    public function comparator(): ComparatorInterface
    {
        return new class implements ComparatorInterface {
            public function compare(mixed $a, mixed $b): int
            {
                return $a->age <=> $b->age;
            }
        };
    }

    public function guard(): ValueGuardInterface
    {
        return new class implements ValueGuardInterface {
            public function assert(mixed $value): void
            {
                if (!is_object($value) || !isset($value->age)) {
                    throw new InvalidArgumentException('Expected object with age');
                }
            }
        };
    }
}
$factory = \M119\SortedLinkedList\Factory\SortedLinkedListFactory::init();
$factory->registry()->registerPolicy('user-age', fn() => new UserAgePolicy());
$list = $factory->createByKey('user-age', 'deque');
```

### Custom strategy
Strategy define storage mechanism. You can use your own strategy.
```php
final class NodeStrategy implements StorageStrategyInterface
{
    ...
}
$factory = \M119\SortedLinkedList\Factory\SortedLinkedListFactory::init();
$factory->registry()->registerStrategy('node', fn() => new NodeStrategy());
$list = $factory->createByKey('int', 'node');
```