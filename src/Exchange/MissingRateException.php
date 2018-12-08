<?php

namespace Money\Exchange;

use Money\Exception;
use UnexpectedValueException;

final class MissingRateException extends UnexpectedValueException implements Exception
{
    /**
     * @var CurrencyPair
     */
    private $currencyPair;

    /**
     * @param CurrencyPair $currencyPair
     */
    public function __construct(CurrencyPair $currencyPair)
    {
        parent::__construct(sprintf('Missing rate %s', (string) $currencyPair));

        $this->currencyPair = $currencyPair;
    }

    /**
     * @return CurrencyPair
     */
    public function getCurrencyPair(): CurrencyPair
    {
        return $this->currencyPair;
    }
}
