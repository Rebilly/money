<?php

namespace Money\Exchange;

use InvalidArgumentException;
use JsonSerializable;
use Money\Currency;

/**
 * @psalm-immutable
 */
final class CurrencyPair implements JsonSerializable
{
    /**
     * @var Currency
     */
    private $baseCurrency;

    /**
     * @var Currency
     */
    private $quoteCurrency;

    /**
     * CurrencyPair constructor.
     *
     * @param Currency $baseCurrency
     * @param Currency $quoteCurrency
     */
    public function __construct(Currency $baseCurrency, Currency $quoteCurrency)
    {
        if ($baseCurrency->equals($quoteCurrency)) {
            throw new InvalidArgumentException('The base currency and target currency must be different');
        }

        $this->baseCurrency = $baseCurrency;
        $this->quoteCurrency = $quoteCurrency;
    }

    /**
     * Returns a string representation of the currency pair.
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s/%s', $this->baseCurrency->getCurrencyCode(), $this->quoteCurrency->getCurrencyCode());
    }

    /**
     * The base currency.
     *
     * @return Currency
     */
    public function getBaseCurrency(): Currency
    {
        return $this->baseCurrency;
    }

    /**
     * The target currency.
     *
     * @return Currency
     */
    public function getQuoteCurrency(): Currency
    {
        return $this->quoteCurrency;
    }

    /**
     * Returns a new CurrencyPair with the base and quote currencies swapped.
     *
     * @return self
     */
    public function getInverse(): self
    {
        return new self($this->getQuoteCurrency(), $this->getBaseCurrency());
    }

    /**
     * Returns true if the currency pair equals the current instance.
     *
     * @param self $currencyPair
     *
     * @return bool
     */
    public function equals(self $currencyPair): bool
    {
        return $this->getBaseCurrency()->equals($currencyPair->getBaseCurrency()) && $this->getQuoteCurrency()->equals($currencyPair->getQuoteCurrency());
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): array
    {
        return [
            'baseCurrency' => $this->getBaseCurrency()->jsonSerialize(),
            'quoteCurrency' => $this->getQuoteCurrency()->jsonSerialize(),
        ];
    }
}
