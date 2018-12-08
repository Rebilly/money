<?php

namespace Money\Exchange;

use DateTimeInterface;

interface RateRepository extends RateProvider
{
    /**
     * Adds new rates.
     *
     * @param Rate $rate
     * @param Rate[] $more
     */
    public function addRates(Rate $rate, Rate ...$more);

    /**
     * Flushes the repository changes.
     */
    public function flush();

    /**
     * Returns the date of the last change.
     *
     * @return DateTimeInterface
     */
    public function getLatModifiedTime(): DateTimeInterface;
}
