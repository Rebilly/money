<?php

namespace Money\Exchange;

interface RateProvider
{
    /**
     * Fetches the rate for the currency pair.
     *
     * @param CurrencyPair $currencyPair
     *
     * @throws MissingRateException
     *
     * @return Rate
     */
    public function fetchRate(CurrencyPair $currencyPair): Rate;
}
