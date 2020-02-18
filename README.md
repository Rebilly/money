[![Software License][ico-license]][link-license]
[![Latest Version on Packagist][ico-version]][link-packagist]
[![GitHub Actions status][ico-github-actions]][link-github]

# Money

[Value Object](http://martinfowler.com/bliki/ValueObject.html) that represents a [monetary value using a currency's smallest unit](http://martinfowler.com/eaaCatalog/money.html).  This library is originally based on Sebastian Bergmann's [discontinued library](https://github.com/sebastianbergmann/money).  It's been updated with support added for currency exchange.

## Installation

Simply add a dependency on `rebilly/money` to your project's `composer.json` file if you use [Composer](https://getcomposer.org/) to manage the dependencies of your project.

## Usage Examples

#### Creating a Money object and accessing its monetary value

```php
use Money\Currency;
use Money\Money;

// Create Money object that represents 1 EUR
$m = new Money(100, new Currency('EUR'));

// Access the Money object's monetary value
print $m->getAmount();

// Access the Money object's monetary value converted to its base units
print $m->getConvertedAmount();
```

The code above produces the output shown below:

    100
    
    1.00

#### Creating a Money object from a string value

```php
use Money\Currency;
use Money\Money;

// Create Money object that represents 12.34 EUR
$m = Money::fromString('12.34', new Currency('EUR'))

// Access the Money object's monetary value
print $m->getAmount();
```

The code above produces the output shown below:

    1234


#### Basic arithmetic using Money objects

```php
use Money\Currency;
use Money\Money;

// Create two Money objects that represent 1 EUR and 2 EUR, respectively
$a = new Money(100, new Currency('EUR'));
$b = new Money(200, new Currency('EUR'));

// Negate a Money object
$c = $a->negate();
print $c->getAmount();

// Calculate the sum of two Money objects
$c = $a->add($b);
print $c->getAmount();

// Calculate the difference of two Money objects
$c = $b->subtract($a);
print $c->getAmount();

// Multiply a Money object with a factor
$c = $a->multiply(2);
print $c->getAmount();
```

The code above produces the output shown below:

    -100
    300
    100
    200


The `compareTo()` method returns an integer less than, equal to, or greater than
zero if the value of one `Money` object is considered to be respectively less
than, equal to, or greater than that of another `Money` object.

You can use the `compareTo()` method to sort an array of `Money` objects using
PHP's built-in sorting functions:

```php
use Money\Currency;
use Money\Money;

$m = array(
    new Money(300, new Currency('EUR')),
    new Money(100, new Currency('EUR')),
    new Money(200, new Currency('EUR'))
);

usort(
    $m,
    function ($a, $b) { return $a->compareTo($b); }
);

foreach ($m as $_m) {
    print $_m->getAmount() . "\n";
}
```

The code above produces the output shown below:

    100
    200
    300

#### Allocate the monetary value represented by a Money object among N targets

```php
use Money\Currency;
use Money\Money;

// Create a Money object that represents 0,99 EUR
$a = new Money(99, new Currency('EUR'));

foreach ($a->allocateToTargets(10) as $t) {
    print $t->getAmount() . "\n";
}
```

The code above produces the output shown below:

    10
    10
    10
    10
    10
    10
    10
    10
    10
    9

#### Allocate the monetary value represented by a Money object using a list of ratios

```php
use Money\Currency;
use Money\Money;

// Create a Money object that represents 0,05 EUR
$a = new Money(5, new Currency('EUR'));

foreach ($a->allocateByRatios(array(3, 7)) as $t) {
    print $t->getAmount() . "\n";
}
```

The code above produces the output shown below:

    2
    3

#### Extract a percentage (and a subtotal) from the monetary value represented by a Money object

```php
use Money\Currency;
use Money\Money;

// Create a Money object that represents 100,00 EUR
$original = new Money(10000, new Currency('EUR'));

// Extract 21% (and the corresponding subtotal)
$extract = $original->extractPercentage(21);

printf(
    "%d = %d + %d\n",
    $original->getAmount(),
    $extract['subtotal']->getAmount(),
    $extract['percentage']->getAmount()
);
```

The code above produces the output shown below:

    10000 = 8265 + 1735

Please note that this extracts the percentage out of a monetary value where the
percentage is already included. If you want to get the percentage of the
monetary value you should use multiplication (`multiply(0.21)`, for instance,
to calculate 21% of a monetary value represented by a Money object) instead.

#### Convert Money object currency to to another Money object given a conversion rate 

```php
use Money\Currency;
use Money\Money;

// Create a Money object that represents 100,00 EUR
$original = new Money(10000, new Currency('EUR'));

$converted = $original->convert(new Currency('USD'), 1.09, PHP_ROUND_HALF_UP);
$converted->getConvertedAmount(); // 109.00
```

#### Convert Money using a Rate Object

```php
$cp = new CurrencyPair(new Currency('USD'), new Currency('EUR'));
$rate = new Rate($cp, new DateTime(), 0.92);

$money = new Money(1000, new Currency('USD'));
$markupBips = 500; // 5% markup

$newMoney = $rate->convert($money)->multiply($markupBips / 10000 + 1);
```

#### Get Currency Exchange Rate Using a Rate Provider

```php
$cp = new CurrencyPair(new Currency('USD'), new Currency('EUR'));
$rateProvider = new InMemoryRateProvider(['EUR/USD' => 1.09, 'USD/EUR' => 0.9172], new DateTime());
$rate = $c->getRate($rateProvider);
```

## Tests

```
phpunit
```

## Security

If you discover a security vulnerability, please report it to security at rebilly dot com.

## License

The Money library is open-sourced under the [MIT License](./LICENSE) distributed with the software. 


[ico-github-actions]: https://github.com/Rebilly/money/workflows/Tests/badge.svg
[ico-version]: https://img.shields.io/packagist/v/Rebilly/money.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/License-MIT-blue.svg?style=flat-square

[link-github]: https://github.com/Rebilly/money
[link-packagist]: https://packagist.org/packages/Rebilly/money
[link-license]: LICENSE
