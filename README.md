# Stdlib

[![Build Status](https://travis-ci.org/hanif/stdlib.svg)](https://travis-ci.org/hanif/stdlib)

Collections of useful classes and interfaces I often use in my projects.

## Classes & Traits

##### PartialFn

Usage:

```php
use Stdlib\Functional\PartialFn;

$mulXYZ = PartialFn::create(function($x, $y, $z) {
    return $x * $y * $z;
});

$x = $mulXYZ(2);
$xy = $x(4);
$xyz = $xy(6);

> echo $xyz;
> 48

```

##### BigDecimal

Usage:

```php
use Stdlib\Math\BigDecimal;

$n = new BigDecimal('12345678900987654321');
$n->mul(12345);

> echo $n;
> '152407406032692592592745'

```

##### Chainable

Usage:

```php
use Stdlib\Util\Chainable;

class Person {
    private $birthday;

    public function getBirthday() {
        return $this->birthday;
    }

    public function setBirthday(\DateTime $date) {
        return $this->birthday = $date;
    }
}

$p1 = new Person();
$p2 = new Person();
$p2->setBirthday(new \DateTime('1990-02-02'));

$bd1 = Chainable::wrap($p1->getBirthday());
$bd2 = Chainable::wrap($p2->getBirthday());

> echo strval($bd1->format('Y-m-d'));
> echo strval($bd2->format('Y-m-d'));
> ''
> '1990-02-02'

```

##### CollectionUtil

Usage:

```
TODO
```

##### ConfigurableTrait

Usage:

```
TODO
```

##### Options

Usage:

```
TODO
```

## Interfaces

##### OperandInterface
##### HierarchicalInterface
##### TreeInterface
##### ConfigurableInterface
##### IdProviderInterface
##### StatusProviderInterface
