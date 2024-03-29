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
        $date = $this->getRateDate();
        $cp = new CurrencyPair(new Currency('USD'), new Currency('EUR'));
        $rate = new Rate($cp, $date, 0.92);

        self::assertSame($cp, $rate->getCurrencyPair());
        self::assertSame($date, $rate->getDate());
        self::assertSame(0.92, $rate->getRatio());

        return $rate;
    }

    /**
     * @depends testCanBeConstructed
     */
    public function testCanBeRecreatedWithNewRatio(Rate $rate)
    {
        $ratio = $rate->getRatio() * 2;
        $mutatedRatio = $rate->withRatio($ratio);

        self::assertNotSame($rate, $mutatedRatio);
        self::assertSame($rate->getCurrencyPair(), $mutatedRatio->getCurrencyPair());
        self::assertSame($rate->getDate(), $mutatedRatio->getDate());
        self::assertSame($ratio, $mutatedRatio->getRatio());

        return $rate;
    }

    /**
     * @depends testCanBeConstructed
     *
     * @param Rate $rate
     */
    public function testCanBeSerialized(Rate $rate): void
    {
        self::assertSame(
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
        self::assertSame(0.92, $rate->getRatio());
    }

    /**
     * @depends testCanBeConstructed
     *
     * @param Rate $rate
     */
    public function testCanGetDate(Rate $rate): void
    {
        self::assertInstanceOf(DateTime::class, $rate->getDate());
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
        self::assertSame(920, $newMoney->getAmount());
        self::assertSame('EUR', $newMoney->getCurrency()->getCurrencyCode());
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
        self::assertSame(966, $newMoney->getAmount());
        self::assertSame('EUR', $newMoney->getCurrency()->getCurrencyCode());
    }

    private function getRateDate(): DateTime
    {
        return new DateTime('2019-03-05 13:32');
    }
}
