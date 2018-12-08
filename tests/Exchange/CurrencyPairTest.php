<?php

namespace Money\Exchange;

use DateTime;
use InvalidArgumentException;
use Money\Currency;
use Money\TestCase;

class CurrencyPairTest extends TestCase
{
    public function testExceptionIsRaisedForMatchingCurrencyConstructorArgument(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new CurrencyPair(new Currency('USD'), new Currency('USD'));
    }

    public function testCanBeConstructedFromDifferentCurrencies()
    {
        $a = new Currency('EUR');
        $b = new Currency('USD');
        $c = new CurrencyPair($a, $b);

        $this->assertInstanceOf(CurrencyPair::class, $c);

        return $c;
    }

    /**
     * @depends testCanBeConstructedFromDifferentCurrencies
     *
     * @param CurrencyPair $pair
     */
    public function testCanBeSerialized(CurrencyPair $pair): void
    {
        $this->assertSame('{"baseCurrency":"EUR","quoteCurrency":"USD"}', json_encode($pair));
    }

    /**
     * @depends testCanBeConstructedFromDifferentCurrencies
     *
     * @param CurrencyPair $c
     */
    public function testCanBeCastToString(CurrencyPair $c): void
    {
        $this->assertSame('EUR/USD', (string) $c);
    }

    /**
     * @depends testCanBeConstructedFromDifferentCurrencies
     *
     * @param CurrencyPair $c
     */
    public function testCanGetBaseCurrency(CurrencyPair $c): void
    {
        $this->assertSame('EUR', $c->getBaseCurrency()->getCurrencyCode());
    }

    /**
     * @depends testCanBeConstructedFromDifferentCurrencies
     *
     * @param CurrencyPair $c
     */
    public function testCanGetTargetCurrency(CurrencyPair $c): void
    {
        $this->assertSame('USD', $c->getQuoteCurrency()->getCurrencyCode());
    }

    /**
     * @depends testCanBeConstructedFromDifferentCurrencies
     *
     * @param CurrencyPair $c
     */
    public function testEquals(CurrencyPair $c): void
    {
        $cp = new CurrencyPair(new Currency('EUR'), new Currency('USD'));
        $this->assertTrue($c->equals($cp));
    }

    /**
     * @depends testCanBeConstructedFromDifferentCurrencies
     *
     * @param CurrencyPair $c
     */
    public function testCanGetRate(CurrencyPair $c): void
    {
        $rateProvider = new InMemoryRateProvider(['EUR/USD' => 1.09], new DateTime());
        $rate = $c->getRate($rateProvider);

        $this->assertInstanceOf(Rate::class, $rate);
        $this->assertSame(1.09, $rate->getRatio());
    }

    /**
     * @depends testCanBeConstructedFromDifferentCurrencies
     *
     * @param CurrencyPair $c
     */
    public function testInverse(CurrencyPair $c): void
    {
        $inverted = $c->getInverse();
        $this->assertFalse($inverted->equals($c));
        $this->assertTrue($inverted->equals(new CurrencyPair(new Currency('USD'), new Currency('EUR'))));
    }
}
