<?php

namespace Money\Exchange;

use DateTimeInterface;
use InvalidArgumentException;
use JsonSerializable;
use Money\CurrencyMismatchException;
use Money\Money;

final class Rate implements JsonSerializable
{
    /**
     * @var float
     */
    private $ratio;

    /**
     * @var DateTimeInterface
     */
    private $date;

    /**
     * @var CurrencyPair
     */
    private $currencyPair;

    /**
     * @psalm-mutation-free
     *
     * @param CurrencyPair $currencyPair
     * @param DateTimeInterface $date
     * @param float $ratio
     */
    public function __construct(CurrencyPair $currencyPair, DateTimeInterface $date, float $ratio)
    {
        if ($ratio <= 0) {
            throw new InvalidArgumentException('ratio must be a positive number');
        }

        $this->currencyPair = $currencyPair;
        $this->date = $date;
        $this->ratio = $ratio;
    }

    /**
     * @psalm-mutation-free
     *
     * @return float
     */
    public function getRatio(): float
    {
        return $this->ratio;
    }

    /**
     * @psalm-mutation-free
     *
     * @return CurrencyPair
     */
    public function getCurrencyPair(): CurrencyPair
    {
        return $this->currencyPair;
    }

    /**
     * @psalm-mutation-free
     *
     * @return DateTimeInterface
     */
    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    /**
     * Convert Money from base currency to target currency.
     *
     * @psalm-mutation-free
     *
     * @param Money $money
     *
     * @return Money
     */
    public function convert(Money $money): Money
    {
        if (!$this->getCurrencyPair()->getBaseCurrency()->equals($money->getCurrency())) {
            throw new CurrencyMismatchException('Mismatch of base currency');
        }

        return $money->convert($this->currencyPair->getQuoteCurrency(), $this->ratio, PHP_ROUND_HALF_UP);
    }

    /**
     * @psalm-mutation-free
     */
    public function withRatio(float $ratio): self
    {
        return new self($this->getCurrencyPair(), $this->getDate(), $ratio);
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): array
    {
        return [
            'baseCurrency' => $this->currencyPair->getBaseCurrency()->jsonSerialize(),
            'quoteCurrency' => $this->currencyPair->getQuoteCurrency()->jsonSerialize(),
            'date' => $this->date->format('c'),
            'ratio' => $this->ratio,
        ];
    }
}
