<?php

namespace Money\Exchange;

use DateTimeInterface;

/**
 * @psalm-type RateRegistry=array<string, float>
 */
final class InMemoryRateProvider implements RateProvider
{
    /**
     * @var RateRegistry
     */
    private $rates;

    /**
     * @var DateTimeInterface
     */
    private $date;

    /**
     * InMemoryRateProvider constructor.
     *
     * Rates array example:
     *
     * ```
     * [
     *    'EUR/USD' => 1.09,
     *    'GBP/USD' => 1.34,
     * ]
     * ```
     *
     * @param RateRegistry $rates Array of rates indexed by currency pair string.
     * @param DateTimeInterface $date The datetime at the time the rates were fetched.
     */
    public function __construct(array $rates, DateTimeInterface $date)
    {
        $this->rates = $rates;
        $this->date = $date;
    }

    /**
     * @param CurrencyPair $currencyPair
     *
     * @return Rate
     */
    public function fetchRate(CurrencyPair $currencyPair): Rate
    {
        $key = (string) $currencyPair;

        if (isset($this->rates[$key])) {
            return new Rate(
                $currencyPair,
                $this->date,
                $this->rates[$key]
            );
        }

        $inverseKey = (string) $currencyPair->getInverse();

        if (isset($this->rates[$inverseKey])) {
            return new Rate(
                $currencyPair,
                $this->date,
                1 / $this->rates[$inverseKey]
            );
        }

        throw new MissingRateException($currencyPair);
    }
}
