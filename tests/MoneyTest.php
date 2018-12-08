<?php

namespace Money;

use InvalidArgumentException;
use OverflowException;
use stdClass;
use UnderflowException;

/**
 * Class MoneyTest.
 */
class MoneyTest extends TestCase
{
    /**
     * Tests invalid value argument.
     */
    public function testCannotBeConstructedUsingInvalidValueArgument(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Money::fromString(null, new Currency('EUR'));
    }

    /**
     * Tests good construction.
     */
    public function testCannotBeConstructedUsingInvalidCurrencyArgument(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Money::fromString(0, new stdClass());
    }

    /**
     * Tests good construction.
     */
    public function testObjectCanBeConstructedFromString(): void
    {
        $m = Money::fromString(0, 'EUR');

        $this->assertSame(0, $m->getAmount());
        $this->assertSame('EUR', $m->getCurrency()->getCurrencyCode());
    }

    /**
     * Tests good construction.
     */
    public function testObjectCanBeConstructedFromIntegerValueAndCurrencyObject()
    {
        $m = new Money(0, new Currency('EUR'));

        $this->assertSame(0, $m->getAmount());
        $this->assertSame('EUR', $m->getCurrency()->getCurrencyCode());

        return $m;
    }

    public function testObjectCanBeConstructedFromStringValueAndCurrencyObject(): void
    {
        $this->assertTrue(
            (new Money(1234, new Currency('EUR')))->equals(
            Money::fromString('12.34', new Currency('EUR'))
            )
        );
    }

    public function testObjectCanBeConstructedFromStringValueAndCurrencyString(): void
    {
        $this->assertTrue(
            (new Money(1234, new Currency('EUR')))->equals(
                Money::fromString('12.34', 'EUR')
            )
        );
    }

    public function testObjectCanBeConstructedFromEmptyValueAndCurrencyObject(): void
    {
        $this->assertTrue(
            (new Money(0, new Currency('EUR')))->equals(
                Money::fromString('', new Currency('EUR'))
            )
        );
    }

    public function testObjectCanBeConstructedFromEmptyValueAndCurrencyString(): void
    {
        $this->assertTrue(
            (new Money(0, new Currency('EUR')))->equals(
                Money::fromString('', 'EUR')
            )
        );
    }

    /**
     * @depends testObjectCanBeConstructedFromIntegerValueAndCurrencyObject
     *
     * @param   Money $m
     */
    public function testAmountCanBeRetrieved(Money $m): void
    {
        $this->assertSame(0, $m->getAmount());
    }

    public function testConvertedAmountCanBeRetrieved(): void
    {
        $m = new Money(1234, new Currency('EUR'));
        $this->assertSame(12.34, $m->getConvertedAmount());
    }

    public function testFormattedAmountCanBeRetrieved(): void
    {
        $m = new Money(120034, new Currency('EUR'));
        $this->assertSame('1 200.34', $m->getFormattedAmount('.', ' '));
        $this->assertSame('€1,200.34', $m->getPrettyPrint('.', ','));
    }

    /**
     * @depends testObjectCanBeConstructedFromIntegerValueAndCurrencyObject
     *
     * @param   Money $m
     */
    public function testCurrencyCanBeRetrieved(Money $m): void
    {
        $this->assertSame(
            (new Currency('EUR'))->getCurrencyCode(),
            $m->getCurrency()->getCurrencyCode()
        );
    }

    public function testAnotherMoneyObjectWithSameCurrencyCanBeAdded(): void
    {
        $a = new Money(1, new Currency('EUR'));
        $b = new Money(2, new Currency('EUR'));
        $c = $a->add($b);

        $this->assertSame(1, $a->getAmount());
        $this->assertSame(2, $b->getAmount());
        $this->assertSame(3, $c->getAmount());
    }

    public function testExceptionIsThrownForOverflowingAddition(): void
    {
        $a = new Money(PHP_INT_MAX, new Currency('EUR'));
        $b = new Money(2, new Currency('EUR'));
        $this->expectException(OverflowException::class);
        $a->add($b);
    }

    public function testExceptionIsRaisedForIntegerOverflow(): void
    {
        $a = new Money(PHP_INT_MAX, new Currency('EUR'));
        $this->expectException(OverflowException::class);
        $a->multiply(2);
    }

    public function testExceptionIsRaisedWhenMoneyObjectWithDifferentCurrencyIsAdded(): void
    {
        $this->expectException(CurrencyMismatchException::class);
        $a = new Money(1, new Currency('EUR'));
        $b = new Money(2, new Currency('USD'));

        $a->add($b);
    }

    public function testAnotherMoneyObjectWithSameCurrencyCanBeSubtracted(): void
    {
        $a = new Money(1, new Currency('EUR'));
        $b = new Money(2, new Currency('EUR'));
        $c = $b->subtract($a);

        $this->assertSame(1, $a->getAmount());
        $this->assertSame(2, $b->getAmount());
        $this->assertSame(1, $c->getAmount());
    }

    public function testExceptionIsThrownForOverflowingSubtraction(): void
    {
        $a = new Money(-PHP_INT_MAX, new Currency('EUR'));
        $b = new Money(2, new Currency('EUR'));
        $this->expectException(UnderflowException::class);
        $a->subtract($b);
    }

    public function testExceptionIsRaisedWhenMoneyObjectWithDifferentCurrencyIsSubtracted(): void
    {
        $this->expectException(CurrencyMismatchException::class);
        $a = new Money(1, new Currency('EUR'));
        $b = new Money(2, new Currency('USD'));

        $b->subtract($a);
    }

    public function testCanBeNegated(): void
    {
        $a = new Money(1, new Currency('EUR'));
        $b = $a->negate();

        $this->assertSame(1, $a->getAmount());
        $this->assertSame(-1, $b->getAmount());
    }

    public function testCanBeMultipliedByAFactor(): void
    {
        $a = new Money(1, new Currency('EUR'));
        $b = $a->multiply(2);

        $this->assertSame(1, $a->getAmount());
        $this->assertSame(2, $b->getAmount());
    }

    public function testExceptionIsRaisedWhenMultipliedUsingInvalidRoundingMode(): void
    {
        $a = new Money(1, new Currency('EUR'));
        $this->expectException(InvalidArgumentException::class);
        $a->multiply(2, 100);
    }

    public function testCanBeAllocatedToNumberOfTargets(): void
    {
        $a = new Money(99, new Currency('EUR'));
        $r = $a->allocateToTargets(10);

        $this->assertEquals(
            [
                new Money(10, new Currency('EUR')),
                new Money(10, new Currency('EUR')),
                new Money(10, new Currency('EUR')),
                new Money(10, new Currency('EUR')),
                new Money(10, new Currency('EUR')),
                new Money(10, new Currency('EUR')),
                new Money(10, new Currency('EUR')),
                new Money(10, new Currency('EUR')),
                new Money(10, new Currency('EUR')),
                new Money(9, new Currency('EUR')),
            ],
            $r
        );
    }

    public function testNegativeAmountCanBeAllocatedToNumberOfTargets(): void
    {
        $a = new Money(-99, new Currency('EUR'));
        $r = $a->allocateToTargets(10);

        $this->assertEquals(
            [
                new Money(-10, new Currency('EUR')),
                new Money(-10, new Currency('EUR')),
                new Money(-10, new Currency('EUR')),
                new Money(-10, new Currency('EUR')),
                new Money(-10, new Currency('EUR')),
                new Money(-10, new Currency('EUR')),
                new Money(-10, new Currency('EUR')),
                new Money(-10, new Currency('EUR')),
                new Money(-10, new Currency('EUR')),
                new Money(-9, new Currency('EUR')),
            ],
            $r
        );
    }

    public function testCannotBeAllocatedToZeroTargets(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $a = new Money(99, new Currency('EUR'));
        $a->allocateToTargets(0);
    }

    public function testPercentageCanBeExtracted(): void
    {
        $original = new Money(10000, new Currency('EUR'));
        $extract = $original->extractPercentage(21);

        $moneyExtracted = new Money(8264, new Currency('EUR'));
        $this->assertTrue($moneyExtracted->equals($extract['subtotal']));

        $remainingMoneyExtracted = new Money(1736, new Currency('EUR'));
        $this->assertTrue($remainingMoneyExtracted->equals($extract['percentage']));
    }

    public function testExceptionIsRaisedWhenTryingToAllocateToInvalidNumberOfTargets(): void
    {
        $a = new Money(0, new Currency('EUR'));
        $this->expectException(InvalidArgumentException::class);
        $a->allocateToTargets(0);
    }

    public function testCanBeAllocatedByRatios(): void
    {
        $a = new Money(5, new Currency('EUR'));
        $r = $a->allocateByRatios([3, 7]);

        $this->assertEquals(
            [
                new Money(2, new Currency('EUR')),
                new Money(3, new Currency('EUR')),
            ],
            $r
        );
    }

    public function testNegativeAmountCanBeAllocatedByRatios(): void
    {
        $a = new Money(-5, new Currency('EUR'));
        $r = $a->allocateByRatios([3, 7]);

        $this->assertEquals(
            [
                new Money(-2, new Currency('EUR')),
                new Money(-3, new Currency('EUR')),
            ],
            $r
        );
    }

    public function testCannotBeAllocatedByZeroRatios(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $a = new Money(5, new Currency('EUR'));
        $a->allocateByRatios([0, 0]);
    }

    public function testCannotBeAllocatedByFloatZeroRatios(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $a = new Money(5, new Currency('EUR'));
        $a->allocateByRatios([0.0, 0.0]);
    }

    public function testCanBeComparedToAnotherMoneyObjectWithSameCurrency(): void
    {
        $a = new Money(1, new Currency('EUR'));
        $b = new Money(2, new Currency('EUR'));

        $this->assertSame(-1, $a->compareTo($b));
        $this->assertSame(1, $b->compareTo($a));
        $this->assertSame(0, $a->compareTo($a));
    }

    /**
     * @depends testCanBeComparedToAnotherMoneyObjectWithSameCurrency
     */
    public function testCanBeComparedToAnotherMoneyObjectWithSameCurrency2(): void
    {
        $a = new Money(1, new Currency('EUR'));
        $b = new Money(2, new Currency('EUR'));

        $this->assertFalse($a->greaterThan($b));
        $this->assertTrue($b->greaterThan($a));
    }

    /**
     * @depends testCanBeComparedToAnotherMoneyObjectWithSameCurrency
     */
    public function testCanBeComparedToAnotherMoneyObjectWithSameCurrency3(): void
    {
        $a = new Money(1, new Currency('EUR'));
        $b = new Money(2, new Currency('EUR'));

        $this->assertFalse($b->lessThan($a));
        $this->assertTrue($a->lessThan($b));
    }

    /**
     * @depends testCanBeComparedToAnotherMoneyObjectWithSameCurrency
     */
    public function testCanBeComparedToAnotherMoneyObjectWithSameCurrency4(): void
    {
        $a = new Money(1, new Currency('EUR'));
        $b = new Money(1, new Currency('EUR'));

        $this->assertSame(0, $a->compareTo($b));
        $this->assertSame(0, $b->compareTo($a));
        $this->assertTrue($a->equals($b));
        $this->assertTrue($b->equals($a));
    }

    /**
     * @depends testCanBeComparedToAnotherMoneyObjectWithSameCurrency
     */
    public function testCanBeComparedToAnotherMoneyObjectWithSameCurrency5(): void
    {
        $a = new Money(2, new Currency('EUR'));
        $b = new Money(2, new Currency('EUR'));
        $c = new Money(1, new Currency('EUR'));

        $this->assertTrue($a->greaterThanOrEqual($a));
        $this->assertTrue($a->greaterThanOrEqual($b));
        $this->assertTrue($a->greaterThanOrEqual($c));
        $this->assertFalse($c->greaterThanOrEqual($a));
    }

    /**
     * @depends testCanBeComparedToAnotherMoneyObjectWithSameCurrency
     */
    public function testCanBeComparedToAnotherMoneyObjectWithSameCurrency6(): void
    {
        $a = new Money(1, new Currency('EUR'));
        $b = new Money(1, new Currency('EUR'));
        $c = new Money(2, new Currency('EUR'));

        $this->assertTrue($a->lessThanOrEqual($a));
        $this->assertTrue($a->lessThanOrEqual($b));
        $this->assertTrue($a->lessThanOrEqual($c));
        $this->assertFalse($c->lessThanOrEqual($a));
    }

    public function testExceptionIsRaisedWhenComparedToMoneyObjectWithDifferentCurrency(): void
    {
        $this->expectException(CurrencyMismatchException::class);
        $a = new Money(1, new Currency('EUR'));
        $b = new Money(2, new Currency('USD'));

        $a->compareTo($b);
    }

    public function testCanBeSerializedToJson(): void
    {
        $this->assertSame(
            '{"amount":1,"currency":"EUR"}',
            json_encode(new Money(1, new Currency('EUR')))
        );
    }

    public function testZero(): void
    {
        $a = new Money(0, new Currency('USD'));
        $this->assertTrue($a->isZero());

        $b = new Money(1, new Currency('USD'));
        $this->assertFalse($b->isZero());
    }

    public function testPositive(): void
    {
        $a = new Money(1, new Currency('USD'));
        $this->assertTrue($a->isPositive());

        $b = new Money(0, new Currency('USD'));
        $this->assertFalse($b->isPositive());
    }

    public function testNegative(): void
    {
        $a = new Money(-1, new Currency('USD'));
        $this->assertTrue($a->isNegative());

        $b = new Money(0, new Currency('USD'));
        $this->assertFalse($b->isNegative());
    }

    public function testConvertEURtoUSD(): void
    {
        $a = new Money(1000, new Currency('EUR'));
        $conversionRate = 1.09;

        $b = $a->convert(new Currency('USD'), $conversionRate, PHP_ROUND_HALF_UP);
        $this->assertSame(1090, $b->getAmount());

        // now convert back:
        $c = $b->convert(new Currency('EUR'), 1 / $conversionRate, PHP_ROUND_HALF_UP);
        $this->assertSame(1000, $c->getAmount());
    }
}
