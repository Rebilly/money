<?php

namespace Money\Exchange;

use DateTimeImmutable;
use Money\Currency;
use Money\TestCase;

class InMemoryRateProviderTest extends TestCase
{
    /**
     * @var InMemoryRateProvider
     */
    private $rateProvider;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->rateProvider = new InMemoryRateProvider(
            [
                'EUR/USD' => 1.25,
                'GBP/USD' => 1.35,
            ],
            new DateTimeImmutable('2017-01-01 01:02:03')
        );
    }

    public function testGetRate(): void
    {
        $pair = new CurrencyPair(new Currency('EUR'), new Currency('USD'));
        $rate = $this->rateProvider->fetchRate($pair);

        self::assertSame(1.25, $rate->getRatio());
        self::assertTrue($rate->getCurrencyPair()->equals($pair));
        self::assertSame((new DateTimeImmutable('2017-01-01 01:02:03'))->getTimestamp(), $rate->getDate()->getTimestamp());

        $pair = new CurrencyPair(new Currency('GBP'), new Currency('USD'));
        $rate = $this->rateProvider->fetchRate($pair);

        self::assertSame(1.35, $rate->getRatio());
        self::assertTrue($rate->getCurrencyPair()->equals($pair));
        self::assertSame((new DateTimeImmutable('2017-01-01 01:02:03'))->getTimestamp(), $rate->getDate()->getTimestamp());
    }

    public function testGetRateFromInversePair(): void
    {
        $pair = new CurrencyPair(new Currency('USD'), new Currency('EUR'));
        $rate = $this->rateProvider->fetchRate($pair);

        self::assertSame(0.80, $rate->getRatio());
        self::assertTrue($rate->getCurrencyPair()->equals($pair));
        self::assertSame((new DateTimeImmutable('2017-01-01 01:02:03'))->getTimestamp(), $rate->getDate()->getTimestamp());
    }

    public function testFailOnMissingRate(): void
    {
        $pair = new CurrencyPair(new Currency('USD'), new Currency('RUB'));
        $exception = new MissingRateException($pair);

        self::assertTrue($exception->getCurrencyPair()->equals($pair));

        $this->expectExceptionObject($exception);

        $this->rateProvider->fetchRate($pair);
    }
}
