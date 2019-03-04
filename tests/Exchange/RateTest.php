<?php

namespace Money\Exchange;

use DateTime;
use InvalidArgumentException;
use Money\Currency;
use Money\CurrencyMismatchException;
use Money\Money;
use Money\TestCase;

class RateTest extends TestCase
{
    public function testExceptionIsRaisedForInvalidConstructorArgument(): void
    {
        $cp = new CurrencyPair(new Currency('USD'), new Currency('EUR'));
        $this->expectException(InvalidArgumentException::class);
        new Rate($cp, $this->getRateDate(), 0);
    }

    public function testCanBeConstructed()
    {
        $cp = new CurrencyPair(new Currency('USD'), new Currency('EUR'));
        $rate = new Rate($cp, $this->getRateDate(), 0.92);

        $this->assertInstanceOf(Rate::class, $rate);

        return $rate;
    }

    /**
     * @depends testCanBeConstructed
     *
     * @param Rate $rate
     */
    public function testCanBeSerialized(Rate $rate): void
    {
        $this->assertSame(
            '{"baseCurrency":"USD","quoteCurrency":"EUR","date":"' . $this->getRateDate()->format('c') . '","ratio":0.92}',
            json_encode($rate)
        );
    }

    /**
     * @depends testCanBeConstructed
     *
     * @param Rate $rate
     */
    public function testCanGetRatio(Rate $rate): void
    {
        $this->assertSame(0.92, $rate->getRatio());
    }

    /**
     * @depends testCanBeConstructed
     *
     * @param Rate $rate
     */
    public function testCanGetCurrencyPair(Rate $rate): void
    {
        $this->assertInstanceOf(CurrencyPair::class, $rate->getCurrencyPair());
    }

    /**
     * @depends testCanBeConstructed
     *
     * @param Rate $rate
     */
    public function testCanGetDate(Rate $rate): void
    {
        $this->assertInstanceOf(DateTime::class, $rate->getDate());
    }

    /**
     * @depends testCanBeConstructed
     *
     * @param Rate $rate
     */
    public function testExceptionIsRaisedForConvertMoneyFromDifferentCurrency(Rate $rate): void
    {
        $money = new Money(1000, new Currency('EUR'));
        $this->expectException(CurrencyMismatchException::class);

        $rate->convert($money);
    }

    /**
     * @depends testCanBeConstructed
     *
     * @param Rate $rate
     */
    public function testCanConvertMoney(Rate $rate): void
    {
        $money = new Money(1000, new Currency('USD'));
        $newMoney = $rate->convert($money);
        $this->assertSame(920, $newMoney->getAmount());
        $this->assertSame('EUR', $newMoney->getCurrency()->getCurrencyCode());
    }

    /**
     * @depends testCanBeConstructed
     *
     * @param Rate $rate
     */
    public function testCanConvertMoneyWithMarkup(Rate $rate): void
    {
        $money = new Money(1000, new Currency('USD'));
        $markupBips = 500; // 5% markup
        $newMoney = $rate->convert($money)->multiply($markupBips / 10000 + 1);

        // the straight conversion without markup is EUR 9.20
        $this->assertSame(966, $newMoney->getAmount());
        $this->assertSame('EUR', $newMoney->getCurrency()->getCurrencyCode());
    }

    private function getRateDate(): DateTime
    {
        return new DateTime('2019-03-05 13:32');
    }
}
