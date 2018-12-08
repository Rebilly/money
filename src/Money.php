<?php

namespace Money;

use InvalidArgumentException;
use JsonSerializable;
use OverflowException;
use UnderflowException;

/**
 * Value Object that represents a monetary value
 * (using a currency's smallest unit).
 *
 * This file is inspired by the Money package, by Sebastian Bergmann
 * and the money solution by Martin Fowler.
 *
 * @see http://www.github.com/sebastianbergmann/money
 * @see http://martinfowler.com/bliki/ValueObject.html
 * @see http://martinfowler.com/eaaCatalog/money.html
 */
final class Money implements JsonSerializable
{
    /**
     * @var int[]
     */
    private const ROUNDING_MODES = [
        PHP_ROUND_HALF_UP,
        PHP_ROUND_HALF_DOWN,
        PHP_ROUND_HALF_EVEN,
        PHP_ROUND_HALF_ODD,
    ];

    /**
     * @var int
     */
    private $amount;

    /**
     * @var Currency
     */
    private $currency;

    /**
     * @param int $amount
     * @param Currency $currency
     *
     * @throws InvalidArgumentException
     */
    public function __construct(int $amount, Currency $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * Creates a Money object from a string such as "12.34".
     *
     * This method is designed to take into account the errors that can arise
     * from manipulating floating point numbers.
     *
     * If the number of decimals in the string is higher than the currency's
     * number of fractional digits then the value will be rounded to the
     * currency's number of fractional digits.
     *
     * @param string $value
     * @param string $currency
     *
     * @throws InvalidArgumentException
     *
     * @return self
     */
    public static function fromString($value, $currency): self
    {
        if (!is_scalar($value) && !is_callable([$value, '__toString'])) {
            throw new InvalidArgumentException('$value must be a string');
        }

        if (!is_scalar($currency) && !is_callable([$currency, '__toString'])) {
            throw new InvalidArgumentException('$currency must be a string');
        }

        $value = (string) $value;
        $currency = new Currency((string) $currency);

        return new self(
            (int) (
                round(
                    $currency->getSubUnit() *
                    round(
                        $value,
                        $currency->getDefaultFractionDigits(),
                        PHP_ROUND_HALF_UP
                    ),
                    0,
                    PHP_ROUND_HALF_UP
                )
            ),
            $currency
        );
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): array
    {
        return [
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency()->jsonSerialize(),
        ];
    }

    /**
     * Returns the monetary value represented by this object.
     *
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * Returns the monetary value represented by this object converted to its base units.
     *
     * @return float
     */
    public function getConvertedAmount(): float
    {
        return round(
            $this->getAmount() / $this->getCurrency()->getSubUnit(),
            $this->getCurrency()->getDefaultFractionDigits(),
            PHP_ROUND_HALF_UP
        );
    }

    /**
     * Formats the monetary value to string.
     *
     * @param string $decimalPoint
     * @param string $thousandsSeparator
     *
     * @return string
     */
    public function getFormattedAmount(string $decimalPoint = '.', string $thousandsSeparator = ','): string
    {
        return number_format(
            $this->getConvertedAmount(),
            $this->getCurrency()->getDefaultFractionDigits(),
            $decimalPoint,
            $thousandsSeparator
        );
    }

    /**
     * Formats the given value to be displayed with its symbol and fractions.
     *
     * There is lack the information about currency symbol position,
     * so it's placed as for USD and many others before amount.
     *
     * @param string $decimalPoint
     * @param string $thousandsSeparator
     *
     * @return string
     */
    public function getPrettyPrint(string $decimalPoint = '.', string $thousandsSeparator = ','): string
    {
        return $this->getCurrency()->getSign() . $this->getFormattedAmount($decimalPoint, $thousandsSeparator);
    }

    /**
     * Returns the currency of the monetary value represented by this object.
     *
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    /**
     * Returns a new Money object that represents the monetary value
     * of the sum of this Money object and another.
     *
     * @param self $other
     *
     * @throws CurrencyMismatchException
     * @throws OverflowException
     *
     * @return self
     */
    public function add(self $other): self
    {
        $this->assertSameCurrency($other);

        $value = $this->getAmount() + $other->getAmount();

        if (!is_int($value)) {
            throw new OverflowException('Value reached maximum amount');
        }

        return $this->changeAmount($value);
    }

    /**
     * Returns a new Money object that represents the monetary value
     * of the difference of this Money object and another.
     *
     * @param self $other
     *
     * @throws CurrencyMismatchException
     * @throws OverflowException
     *
     * @return self
     */
    public function subtract(self $other): self
    {
        $this->assertSameCurrency($other);

        $value = $this->getAmount() - $other->getAmount();

        if (!is_int($value)) {
            throw new UnderflowException('Value reached minimum amount');
        }

        return $this->changeAmount($value);
    }

    /**
     * Returns a new Money object that represents the negated monetary value
     * of this Money object.
     *
     * @return self
     */
    public function negate(): self
    {
        return $this->changeAmount(-1 * $this->getAmount());
    }

    /**
     * Returns a new Money object that represents the monetary value
     * of this Money object multiplied by a given factor.
     *
     * @param float $factor
     * @param int $roundingMode
     *
     * @throws InvalidArgumentException
     *
     * @return self
     */
    public function multiply(float $factor, int $roundingMode = PHP_ROUND_HALF_UP): self
    {
        $this->assertRoundingMode($roundingMode);

        $amount = round($factor * $this->getAmount(), 0, $roundingMode);

        return $this->changeFloatAmount($amount);
    }

    /**
     * Allocate the monetary value represented by this Money object
     * among N targets.
     *
     * @param int $n
     *
     * @throws InvalidArgumentException
     *
     * @return self[]
     */
    public function allocateToTargets(int $n): array
    {
        if ($n === 0) {
            throw new InvalidArgumentException('$n must not be zero');
        }

        $sign = ($this->getAmount() < 0) ? -1 : 1;
        $amount = abs($this->getAmount());
        $low = $this->changeAmount((int) ($amount / $n));
        $high = $this->changeAmount($low->getAmount() + 1);
        $remainder = $amount % $n;
        $result = [];

        for ($i = 0; $i < $remainder; $i++) {
            $result[] = $high->multiply($sign);
        }

        for ($i = $remainder; $i < $n; $i++) {
            $result[] = $low->multiply($sign);
        }

        return $result;
    }

    /**
     * Allocate the monetary value represented by this Money object
     * using a list of ratios.
     *
     * @param array $ratios
     *
     * @return self[]
     */
    public function allocateByRatios(array $ratios): array
    {
        $total = array_sum($ratios);

        if ($total === 0.0 || $total === 0) {
            throw new InvalidArgumentException('The ratios sum must not be zero');
        }

        $result = [];
        $sign = $this->isNegative() ? -1 : 1;
        $absAmount = abs($this->getAmount());
        $remainder = $absAmount;

        foreach ($ratios as $ratio) {
            $money = $this->changeFloatAmount($absAmount * $ratio / $total * $sign);
            $remainder -= abs($money->getAmount());
            $result[] = $money;
        }

        for ($i = 0; $i < $remainder; $i++) {
            $result[$i] = $this->changeAmount($result[$i]->getAmount() + $sign);
        }

        return $result;
    }

    /**
     * Extracts a percentage of the monetary value represented by this Money
     * object and returns an array of two Money objects:
     * $original = $result['subtotal'] + $result['percentage'];.
     *
     * Please note that this extracts the percentage out of a monetary value
     * where the percentage is already included. If you want to get the
     * percentage of the monetary value you should use multiplication
     * (multiply(0.21), for instance, to calculate 21% of a monetary value
     * represented by a Money object) instead.
     *
     * @see https://github.com/sebastianbergmann/money/issues/27
     *
     * @param float $percentage
     * @param int $roundingMode
     *
     * @return self[]
     */
    public function extractPercentage($percentage, $roundingMode = PHP_ROUND_HALF_UP): array
    {
        $amount = round($this->getAmount() / (100 + $percentage) * $percentage, 0, $roundingMode);
        $percentage = $this->changeFloatAmount($amount);

        return [
            'percentage' => $percentage,
            'subtotal' => $this->subtract($percentage),
        ];
    }

    /**
     * Compares this Money object to another.
     *
     * Returns an integer less than, equal to, or greater than zero
     * if the value of this Money object is considered to be respectively
     * less than, equal to, or greater than the other Money object.
     *
     * @param self $other
     *
     * @throws CurrencyMismatchException
     *
     * @return int -1|0|1
     */
    public function compareTo(self $other): int
    {
        $this->assertSameCurrency($other);

        return $this->getAmount() <=> $other->getAmount();
    }

    /**
     * Returns TRUE if this Money object equals to another.
     *
     * @param self $other
     *
     * @throws CurrencyMismatchException
     *
     * @return bool
     */
    public function equals(self $other): bool
    {
        return $this->getCurrency()->equals($other->getCurrency()) && $this->compareTo($other) === 0;
    }

    /**
     * Returns TRUE if the monetary value represented by this Money object
     * is greater than that of another, FALSE otherwise.
     *
     * @param self $other
     *
     * @throws CurrencyMismatchException
     *
     * @return bool
     */
    public function greaterThan(self $other): bool
    {
        return $this->compareTo($other) === 1;
    }

    /**
     * Returns TRUE if the monetary value represented by this Money object
     * is greater than or equal that of another, FALSE otherwise.
     *
     * @param self $other
     *
     * @throws CurrencyMismatchException
     *
     * @return bool
     */
    public function greaterThanOrEqual(self $other): bool
    {
        return $this->greaterThan($other) || $this->equals($other);
    }

    /**
     * Returns TRUE if the monetary value represented by this Money object
     * is smaller than that of another, FALSE otherwise.
     *
     * @param self $other
     *
     * @throws CurrencyMismatchException
     *
     * @return bool
     */
    public function lessThan(self $other): bool
    {
        return $this->compareTo($other) === -1;
    }

    /**
     * Returns TRUE if the monetary value represented by this Money object
     * is smaller than or equal that of another, FALSE otherwise.
     *
     * @param self $other
     *
     * @throws CurrencyMismatchException
     *
     * @return bool
     */
    public function lessThanOrEqual(self $other): bool
    {
        return $this->lessThan($other) || $this->equals($other);
    }

    /**
     * @return bool
     */
    public function isZero(): bool
    {
        return $this->getAmount() === 0;
    }

    /**
     * @return bool
     */
    public function isPositive(): bool
    {
        return $this->getAmount() > 0;
    }

    /**
     * @return bool
     */
    public function isNegative(): bool
    {
        return $this->getAmount() < 0;
    }

    /**
     * Convert currency to a target currency given a conversion rate and rounding mode.
     *
     * @param Currency $targetCurrency
     * @param $conversionRate
     * @param $roundingMode
     *
     * @return self
     */
    public function convert(Currency $targetCurrency, float $conversionRate, int $roundingMode): self
    {
        $this->assertRoundingMode($roundingMode);

        $targetAmount = $this->castToInt(round($conversionRate * $this->getAmount(), 0, $roundingMode));

        return new self($targetAmount, $targetCurrency);
    }

    /**
     * Asserts that rounding mode is a valid integer value.
     *
     * @param int $roundingMode
     *
     * @throws InvalidArgumentException
     */
    private function assertRoundingMode(int $roundingMode): void
    {
        if (!in_array($roundingMode, self::ROUNDING_MODES, true)) {
            throw new InvalidArgumentException('$roundingMode must be a valid rounding mode (PHP_ROUND_*)');
        }
    }

    private function assertSameCurrency(self $other): void
    {
        if (!$this->getCurrency()->equals($other->getCurrency())) {
            throw new CurrencyMismatchException();
        }
    }

    /**
     * Cast an amount to an integer but ensure that the operation won't hide overflow.
     *
     * @param float $amount
     *
     * @throws OverflowException
     *
     * @return int
     */
    private function castToInt(float $amount): int
    {
        if (abs($amount) > PHP_INT_MAX) {
            throw new OverflowException();
        }

        return (int) $amount;
    }

    /**
     * @param int $amount
     *
     * @return self
     */
    private function changeAmount(int $amount): self
    {
        return new self($amount, $this->getCurrency());
    }

    /**
     * @param float $amount
     *
     * @return self
     */
    private function changeFloatAmount(float $amount): self
    {
        return $this->changeAmount($this->castToInt($amount));
    }
}
