<?php

namespace Money;

use Generator;
use InvalidArgumentException;

class CurrencyTest extends TestCase
{
    /**
     * @dataProvider provideCurrenciesData
     *
     * @param string $isoAlphaCode
     * @param array $item
     */
    public function testCurrenciesDbIntegrity(string $isoAlphaCode, array $item): void
    {
        self::assertSame(3, mb_strlen($isoAlphaCode));

        self::assertArrayHasKey('display_name', $item, "Testing {$isoAlphaCode}");
        self::assertArrayHasKey('numeric_code', $item, "Testing {$isoAlphaCode}");
        self::assertArrayHasKey('default_fraction_digits', $item, "Testing {$isoAlphaCode}");
        self::assertArrayHasKey('sub_unit', $item, "Testing {$isoAlphaCode}");
        self::assertArrayHasKey('sign', $item, "Testing {$isoAlphaCode}");
        self::assertArrayHasKey('deprecated', $item, "Testing {$isoAlphaCode}");

        self::assertNotEmpty($item['display_name'], "Testing {$isoAlphaCode}");
        self::assertGreaterThan(0, $item['numeric_code'], "Testing {$isoAlphaCode}");
        self::assertGreaterThanOrEqual(0, $item['default_fraction_digits'], "Testing {$isoAlphaCode}");
        self::assertGreaterThanOrEqual(0, $item['sub_unit'], "Testing {$isoAlphaCode}");
        self::assertNotEmpty($item['sign'], "Testing {$isoAlphaCode}");
        self::assertIsBool($item['deprecated'], "Testing {$isoAlphaCode}");
    }

    public function testExceptionIsRaisedForInvalidConstructorArgument(): void
    {
        $this->expectExceptionObject(new InvalidArgumentException('Unknown currency code ""'));
        new Currency('');
    }

    public function testCanBeConstructedFromUppercaseString(): void
    {
        $c = new Currency('EUR');

        $this->assertSame('EUR', $c->getCurrencyCode());
        $this->assertSame(2, $c->getDefaultFractionDigits());
        $this->assertSame('Euro', $c->getDisplayName());
        $this->assertSame(978, $c->getNumericCode());
        $this->assertSame(100, $c->getSubUnit());
        $this->assertSame('€', $c->getSign());
        $this->assertFalse($c->isDeprecated());
    }

    public function testCanBeConstructedFromLowercaseString(): void
    {
        $c = new Currency('eur');

        $this->assertSame('EUR', $c->getCurrencyCode());
    }

    public function testCustomCurrencyCanBeRegistered(): void
    {
        Currency::addCurrency('BTC', 'Bitcoin', 999, 4, 1000);
        $c = new Currency('BTC');

        $this->assertSame('BTC', $c->getCurrencyCode());
    }

    public function testRegisteredCurrenciesCanBeAccessed(): void
    {
        $currencies = Currency::getCurrencies();

        $this->assertInternalType('array', $currencies);
        $this->assertArrayHasKey('EUR', $currencies);
        $this->assertInternalType('array', $currencies['EUR']);
        $this->assertArrayHasKey('display_name', $currencies['EUR']);
        $this->assertArrayHasKey('numeric_code', $currencies['EUR']);
        $this->assertArrayHasKey('default_fraction_digits', $currencies['EUR']);
        $this->assertArrayHasKey('sub_unit', $currencies['EUR']);
        $this->assertArrayHasKey('deprecated', $currencies['EUR']);

        // check that getCurrencies() method doesn't return deprecated currencies
        $this->assertArrayNotHasKey('BYR', $currencies);
    }

    public function testGetCurrenciesIncludingDeprecated(): void
    {
        $currencies = Currency::getCurrenciesIncludingDeprecated();

        $activeCurrency = 'EUR';
        $deprecatedCurrency = 'BYR';

        $this->assertArrayHasKey($activeCurrency, $currencies);
        $this->assertArrayHasKey($deprecatedCurrency, $currencies);
    }

    public function testCanBeCastToString(): void
    {
        $this->assertSame('EUR', (string) new Currency('EUR'));
    }

    public function testCanCreateByNumCode(): void
    {
        $this->assertSame('EUR', Currency::fromNumericCode(978)->getCurrencyCode());
    }

    public function testDeprecation(): void
    {
        $activeCurrency = new Currency('EUR');
        $deprecatedCurrency = new Currency('BYR');

        $this->assertFalse($activeCurrency->isDeprecated());
        $this->assertTrue($deprecatedCurrency->isDeprecated());
    }

    public function testExceptionIsRaisedForInvalidNumCode(): void
    {
        $this->expectExceptionObject(new InvalidArgumentException('Unknown currency code "0"'));
        Currency::fromNumericCode(0);
    }

    /**
     * @return Generator
     */
    public function provideCurrenciesData(): Generator
    {
        $data = Currency::getCurrencies();

        foreach ($data as $isoAlphaCode => $item) {
            yield [$isoAlphaCode, $item];
        }
    }
}
