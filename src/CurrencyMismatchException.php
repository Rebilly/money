<?php

namespace Money;

use InvalidArgumentException;

final class CurrencyMismatchException extends InvalidArgumentException implements Exception
{
    /**
     * @param string $message
     */
    public function __construct(string $message = 'Mismatch of the currency')
    {
        parent::__construct($message);
    }
}
