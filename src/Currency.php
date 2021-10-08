<?php

namespace Money;

use InvalidArgumentException;
use JsonSerializable;

/**
 * Value Object that represents a currency.
 *
 * Loosely based on the java.util.Currency class of the Java SDK.
 *
 * @see http://www.github.com/sebastianbergmann/money
 * @see http://docs.oracle.com/javase/7/docs/api/java/util/Currency.html
 */
final class Currency implements JsonSerializable
{
    /**
     * @var array<string, array{display_name: string, numeric_code: int, default_fraction_digits: int, sub_unit: int, sign: string, deprecated: boolean}>
     */
    private static $currencies = [
        'AED' => [
            'display_name' => 'UAE Dirham',
            'numeric_code' => 784,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'د.إ',
            'deprecated' => false,
        ],
        'AFN' => [
            'display_name' => 'Afghani',
            'numeric_code' => 971,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '؋',
            'deprecated' => false,
        ],
        'ALL' => [
            'display_name' => 'Lek',
            'numeric_code' => 8,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'L',
            'deprecated' => false,
        ],
        'AMD' => [
            'display_name' => 'Armenian Dram',
            'numeric_code' => 51,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '֏',
            'deprecated' => false,
        ],
        'ANG' => [
            'display_name' => 'Netherlands Antillean Guilder',
            'numeric_code' => 532,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'ƒ',
            'deprecated' => false,
        ],
        'AOA' => [
            'display_name' => 'Kwanza',
            'numeric_code' => 973,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Kz',
            'deprecated' => false,
        ],
        'ARS' => [
            'display_name' => 'Argentine Peso',
            'numeric_code' => 32,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'AUD' => [
            'display_name' => 'Australian Dollar',
            'numeric_code' => 36,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'AWG' => [
            'display_name' => 'Aruban Florin',
            'numeric_code' => 533,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'ƒ',
            'deprecated' => false,
        ],
        'AZN' => [
            'display_name' => 'Azerbaijanian Manat',
            'numeric_code' => 944,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'm',
            'deprecated' => false,
        ],
        'BAM' => [
            'display_name' => 'Convertible Mark',
            'numeric_code' => 977,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'KM',
            'deprecated' => false,
        ],
        'BBD' => [
            'display_name' => 'Barbados Dollar',
            'numeric_code' => 52,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'BDT' => [
            'display_name' => 'Taka',
            'numeric_code' => 50,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '৳',
            'deprecated' => false,
        ],
        'BGN' => [
            'display_name' => 'Bulgarian Lev',
            'numeric_code' => 975,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'лв',
            'deprecated' => false,
        ],
        'BHD' => [
            'display_name' => 'Bahraini Dinar',
            'numeric_code' => 48,
            'default_fraction_digits' => 3,
            'sub_unit' => 1000,
            'sign' => '.د.ب',
            'deprecated' => false,
        ],
        'BIF' => [
            'display_name' => 'Burundi Franc',
            'numeric_code' => 108,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'FBu',
            'deprecated' => false,
        ],
        'BMD' => [
            'display_name' => 'Bermudian Dollar',
            'numeric_code' => 60,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'BND' => [
            'display_name' => 'Brunei Dollar',
            'numeric_code' => 96,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'BOB' => [
            'display_name' => 'Boliviano',
            'numeric_code' => 68,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$b',
            'deprecated' => false,
        ],
        'BOV' => [
            'display_name' => 'Mvdol',
            'numeric_code' => 984,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'BOV',
            'deprecated' => false,
        ],
        'BRL' => [
            'display_name' => 'Brazilian Real',
            'numeric_code' => 986,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'R$',
            'deprecated' => false,
        ],
        'BSD' => [
            'display_name' => 'Bahamian Dollar',
            'numeric_code' => 44,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'BTN' => [
            'display_name' => 'Ngultrum',
            'numeric_code' => 64,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Nu.',
            'deprecated' => false,
        ],
        'BWP' => [
            'display_name' => 'Pula',
            'numeric_code' => 72,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'P',
            'deprecated' => false,
        ],
        'BYR' => [
            'display_name' => 'Belarussian Ruble',
            'numeric_code' => 974,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'Br',
            'deprecated' => true,
        ],
        'BYN' => [
            'display_name' => 'Belarussian Ruble',
            'numeric_code' => 933,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Br',
            'deprecated' => false,
        ],
        'BZD' => [
            'display_name' => 'Belize Dollar',
            'numeric_code' => 84,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'CAD' => [
            'display_name' => 'Canadian Dollar',
            'numeric_code' => 124,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'CDF' => [
            'display_name' => 'Congolese Franc',
            'numeric_code' => 976,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'FC',
            'deprecated' => false,
        ],
        'CHE' => [
            'display_name' => 'WIR Euro',
            'numeric_code' => 947,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'CHE',
            'deprecated' => false,
        ],
        'CHF' => [
            'display_name' => 'Swiss Franc',
            'numeric_code' => 756,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'CHF',
            'deprecated' => false,
        ],
        'CHW' => [
            'display_name' => 'WIR Franc',
            'numeric_code' => 948,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'CHW',
            'deprecated' => false,
        ],
        'CLF' => [
            'display_name' => 'Unidades de fomento',
            'numeric_code' => 990,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'UF',
            'deprecated' => false,
        ],
        'CLP' => [
            'display_name' => 'Chilean Peso',
            'numeric_code' => 152,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'CNY' => [
            'display_name' => 'Yuan Renminbi',
            'numeric_code' => 156,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '¥',
            'deprecated' => false,
        ],
        'COP' => [
            'display_name' => 'Colombian Peso',
            'numeric_code' => 170,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'COU' => [
            'display_name' => 'Unidad de Valor Real',
            'numeric_code' => 970,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'COU',
            'deprecated' => false,
        ],
        'CRC' => [
            'display_name' => 'Costa Rican Colon',
            'numeric_code' => 188,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₡',
            'deprecated' => false,
        ],
        'CUC' => [
            'display_name' => 'Peso Convertible',
            'numeric_code' => 931,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'CUP' => [
            'display_name' => 'Cuban Peso',
            'numeric_code' => 192,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₱',
            'deprecated' => false,
        ],
        'CVE' => [
            'display_name' => 'Cape Verde Escudo',
            'numeric_code' => 132,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'CZK' => [
            'display_name' => 'Czech Koruna',
            'numeric_code' => 203,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Kč',
            'deprecated' => false,
        ],
        'DJF' => [
            'display_name' => 'Djibouti Franc',
            'numeric_code' => 262,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'Fdj',
            'deprecated' => false,
        ],
        'DKK' => [
            'display_name' => 'Danish Krone',
            'numeric_code' => 208,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'kr.',
            'deprecated' => false,
        ],
        'DOP' => [
            'display_name' => 'Dominican Peso',
            'numeric_code' => 214,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'RD$',
            'deprecated' => false,
        ],
        'DZD' => [
            'display_name' => 'Algerian Dinar',
            'numeric_code' => 12,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'دج',
            'deprecated' => false,
        ],
        'EGP' => [
            'display_name' => 'Egyptian Pound',
            'numeric_code' => 818,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '£',
            'deprecated' => false,
        ],
        'ERN' => [
            'display_name' => 'Nakfa',
            'numeric_code' => 232,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Nfk',
            'deprecated' => false,
        ],
        'ETB' => [
            'display_name' => 'Ethiopian Birr',
            'numeric_code' => 230,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Br',
            'deprecated' => false,
        ],
        'EUR' => [
            'display_name' => 'Euro',
            'numeric_code' => 978,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '€',
            'deprecated' => false,
        ],
        'FJD' => [
            'display_name' => 'Fiji Dollar',
            'numeric_code' => 242,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'FKP' => [
            'display_name' => 'Falkland Islands Pound',
            'numeric_code' => 238,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '£',
            'deprecated' => false,
        ],
        'GBP' => [
            'display_name' => 'Pound Sterling',
            'numeric_code' => 826,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '£',
            'deprecated' => false,
        ],
        'GEL' => [
            'display_name' => 'Lari',
            'numeric_code' => 981,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'ლ',
            'deprecated' => false,
        ],
        'GHS' => [
            'display_name' => 'Ghana Cedi',
            'numeric_code' => 936,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '¢',
            'deprecated' => false,
        ],
        'GIP' => [
            'display_name' => 'Gibraltar Pound',
            'numeric_code' => 292,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '£',
            'deprecated' => false,
        ],
        'GMD' => [
            'display_name' => 'Dalasi',
            'numeric_code' => 270,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'D',
            'deprecated' => false,
        ],
        'GNF' => [
            'display_name' => 'Guinea Franc',
            'numeric_code' => 324,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'FG',
            'deprecated' => false,
        ],
        'GTQ' => [
            'display_name' => 'Quetzal',
            'numeric_code' => 320,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Q',
            'deprecated' => false,
        ],
        'GYD' => [
            'display_name' => 'Guyana Dollar',
            'numeric_code' => 328,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'HKD' => [
            'display_name' => 'Hong Kong Dollar',
            'numeric_code' => 344,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'HNL' => [
            'display_name' => 'Lempira',
            'numeric_code' => 340,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'L',
            'deprecated' => false,
        ],
        'HRK' => [
            'display_name' => 'Croatian Kuna',
            'numeric_code' => 191,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'kn',
            'deprecated' => false,
        ],
        'HTG' => [
            'display_name' => 'Gourde',
            'numeric_code' => 332,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'G',
            'deprecated' => false,
        ],
        'HUF' => [
            'display_name' => 'Forint',
            'numeric_code' => 348,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Ft',
            'deprecated' => false,
        ],
        'IDR' => [
            'display_name' => 'Rupiah',
            'numeric_code' => 360,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Rp',
            'deprecated' => false,
        ],
        'ILS' => [
            'display_name' => 'New Israeli Sheqel',
            'numeric_code' => 376,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₪',
            'deprecated' => false,
        ],
        'INR' => [
            'display_name' => 'Indian Rupee',
            'numeric_code' => 356,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₹',
            'deprecated' => false,
        ],
        'IQD' => [
            'display_name' => 'Iraqi Dinar',
            'numeric_code' => 368,
            'default_fraction_digits' => 3,
            'sub_unit' => 1000,
            'sign' => 'ع.د',
            'deprecated' => false,
        ],
        'IRR' => [
            'display_name' => 'Iranian Rial',
            'numeric_code' => 364,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '﷼',
            'deprecated' => false,
        ],
        'ISK' => [
            'display_name' => 'Iceland Krona',
            'numeric_code' => 352,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'kr',
            'deprecated' => false,
        ],
        'JMD' => [
            'display_name' => 'Jamaican Dollar',
            'numeric_code' => 388,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'JOD' => [
            'display_name' => 'Jordanian Dinar',
            'numeric_code' => 400,
            'default_fraction_digits' => 3,
            'sub_unit' => 100,
            'sign' => 'د.ا',
            'deprecated' => false,
        ],
        'JPY' => [
            'display_name' => 'Yen',
            'numeric_code' => 392,
            'default_fraction_digits' => 0,
            'sub_unit' => 1,
            'sign' => '¥',
            'deprecated' => false,
        ],
        'KES' => [
            'display_name' => 'Kenyan Shilling',
            'numeric_code' => 404,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Sh',
            'deprecated' => false,
        ],
        'KGS' => [
            'display_name' => 'Som',
            'numeric_code' => 417,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'сом',
            'deprecated' => false,
        ],
        'KHR' => [
            'display_name' => 'Riel',
            'numeric_code' => 116,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '៛',
            'deprecated' => false,
        ],
        'KMF' => [
            'display_name' => 'Comoro Franc',
            'numeric_code' => 174,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'CF',
            'deprecated' => false,
        ],
        'KPW' => [
            'display_name' => 'North Korean Won',
            'numeric_code' => 408,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₩',
            'deprecated' => false,
        ],
        'KRW' => [
            'display_name' => 'Won',
            'numeric_code' => 410,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => '₩',
            'deprecated' => false,
        ],
        'KWD' => [
            'display_name' => 'Kuwaiti Dinar',
            'numeric_code' => 414,
            'default_fraction_digits' => 3,
            'sub_unit' => 1000,
            'sign' => 'د.ك',
            'deprecated' => false,
        ],
        'KYD' => [
            'display_name' => 'Cayman Islands Dollar',
            'numeric_code' => 136,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'KZT' => [
            'display_name' => 'Tenge',
            'numeric_code' => 398,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₸',
            'deprecated' => false,
        ],
        'LAK' => [
            'display_name' => 'Kip',
            'numeric_code' => 418,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₭',
            'deprecated' => false,
        ],
        'LBP' => [
            'display_name' => 'Lebanese Pound',
            'numeric_code' => 422,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '£',
            'deprecated' => false,
        ],
        'LKR' => [
            'display_name' => 'Sri Lanka Rupee',
            'numeric_code' => 144,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₨',
            'deprecated' => false,
        ],
        'LRD' => [
            'display_name' => 'Liberian Dollar',
            'numeric_code' => 430,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'LSL' => [
            'display_name' => 'Loti',
            'numeric_code' => 426,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'L',
            'deprecated' => false,
        ],
        'LTL' => [
            'display_name' => 'Lithuanian Litas',
            'numeric_code' => 440,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Lt',
            'deprecated' => true,
        ],
        'LVL' => [
            'display_name' => 'Latvian Lats',
            'numeric_code' => 428,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Ls',
            'deprecated' => true,
        ],
        'LYD' => [
            'display_name' => 'Libyan Dinar',
            'numeric_code' => 434,
            'default_fraction_digits' => 3,
            'sub_unit' => 1000,
            'sign' => 'ل.د',
            'deprecated' => false,
        ],
        'MAD' => [
            'display_name' => 'Moroccan Dirham',
            'numeric_code' => 504,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'د.م.',
            'deprecated' => false,
        ],
        'MDL' => [
            'display_name' => 'Moldovan Leu',
            'numeric_code' => 498,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'MDL',
            'deprecated' => false,
        ],
        'MGA' => [
            'display_name' => 'Malagasy Ariary',
            'numeric_code' => 969,
            'default_fraction_digits' => 2,
            'sub_unit' => 5,
            'sign' => 'Ar',
            'deprecated' => false,
        ],
        'MKD' => [
            'display_name' => 'Denar',
            'numeric_code' => 807,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'ден',
            'deprecated' => false,
        ],
        'MMK' => [
            'display_name' => 'Kyat',
            'numeric_code' => 104,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'K',
            'deprecated' => false,
        ],
        'MNT' => [
            'display_name' => 'Tugrik',
            'numeric_code' => 496,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₮',
            'deprecated' => false,
        ],
        'MOP' => [
            'display_name' => 'Pataca',
            'numeric_code' => 446,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'P',
            'deprecated' => false,
        ],
        'MRU' => [
            'display_name' => 'Ouguiya',
            'numeric_code' => 929,
            'default_fraction_digits' => 2,
            'sub_unit' => 5,
            'sign' => 'UM',
            'deprecated' => false,
        ],
        'MRO' => [
            'display_name' => 'Ouguiya',
            'numeric_code' => 478,
            'default_fraction_digits' => 2,
            'sub_unit' => 5,
            'sign' => 'UM',
            'deprecated' => true,
        ],
        'MUR' => [
            'display_name' => 'Mauritius Rupee',
            'numeric_code' => 480,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₨',
            'deprecated' => false,
        ],
        'MVR' => [
            'display_name' => 'Rufiyaa',
            'numeric_code' => 462,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Rf',
            'deprecated' => false,
        ],
        'MWK' => [
            'display_name' => 'Kwacha',
            'numeric_code' => 454,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'MK',
            'deprecated' => false,
        ],
        'MXN' => [
            'display_name' => 'Mexican Peso',
            'numeric_code' => 484,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'MXV' => [
            'display_name' => 'Mexican Unidad de Inversion (UDI)',
            'numeric_code' => 979,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'MXV',
            'deprecated' => false,
        ],
        'MYR' => [
            'display_name' => 'Malaysian Ringgit',
            'numeric_code' => 458,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'RM',
            'deprecated' => false,
        ],
        'MZN' => [
            'display_name' => 'Mozambique Metical',
            'numeric_code' => 943,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'MT',
            'deprecated' => false,
        ],
        'NAD' => [
            'display_name' => 'Namibia Dollar',
            'numeric_code' => 516,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'NGN' => [
            'display_name' => 'Naira',
            'numeric_code' => 566,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₦',
            'deprecated' => false,
        ],
        'NIO' => [
            'display_name' => 'Cordoba Oro',
            'numeric_code' => 558,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'NOK' => [
            'display_name' => 'Norwegian Krone',
            'numeric_code' => 578,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'kr',
            'deprecated' => false,
        ],
        'NPR' => [
            'display_name' => 'Nepalese Rupee',
            'numeric_code' => 524,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₨',
            'deprecated' => false,
        ],
        'NZD' => [
            'display_name' => 'New Zealand Dollar',
            'numeric_code' => 554,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'OMR' => [
            'display_name' => 'Rial Omani',
            'numeric_code' => 512,
            'default_fraction_digits' => 3,
            'sub_unit' => 1000,
            'sign' => '﷼',
            'deprecated' => false,
        ],
        'PAB' => [
            'display_name' => 'Balboa',
            'numeric_code' => 590,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'B/.',
            'deprecated' => false,
        ],
        'PEN' => [
            'display_name' => 'Nuevo Sol',
            'numeric_code' => 604,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'S/.',
            'deprecated' => false,
        ],
        'PGK' => [
            'display_name' => 'Kina',
            'numeric_code' => 598,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'K',
            'deprecated' => false,
        ],
        'PHP' => [
            'display_name' => 'Philippine Peso',
            'numeric_code' => 608,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₱',
            'deprecated' => false,
        ],
        'PKR' => [
            'display_name' => 'Pakistan Rupee',
            'numeric_code' => 586,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₨',
            'deprecated' => false,
        ],
        'PLN' => [
            'display_name' => 'Zloty',
            'numeric_code' => 985,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'zł',
            'deprecated' => false,
        ],
        'PYG' => [
            'display_name' => 'Guarani',
            'numeric_code' => 600,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => '₲',
            'deprecated' => false,
        ],
        'QAR' => [
            'display_name' => 'Qatari Rial',
            'numeric_code' => 634,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '﷼',
            'deprecated' => false,
        ],
        'RON' => [
            'display_name' => 'New Romanian Leu',
            'numeric_code' => 946,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'lei',
            'deprecated' => false,
        ],
        'RSD' => [
            'display_name' => 'Serbian Dinar',
            'numeric_code' => 941,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'дин.',
            'deprecated' => false,
        ],
        'RUB' => [
            'display_name' => 'Russian Ruble',
            'numeric_code' => 643,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₽',
            'deprecated' => false,
        ],
        'RWF' => [
            'display_name' => 'Rwanda Franc',
            'numeric_code' => 646,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'FRw',
            'deprecated' => false,
        ],
        'SAR' => [
            'display_name' => 'Saudi Riyal',
            'numeric_code' => 682,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '﷼',
            'deprecated' => false,
        ],
        'SBD' => [
            'display_name' => 'Solomon Islands Dollar',
            'numeric_code' => 90,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'SCR' => [
            'display_name' => 'Seychelles Rupee',
            'numeric_code' => 690,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'SR',
            'deprecated' => false,
        ],
        'SDG' => [
            'display_name' => 'Sudanese Pound',
            'numeric_code' => 938,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '£',
            'deprecated' => false,
        ],
        'SEK' => [
            'display_name' => 'Swedish Krona',
            'numeric_code' => 752,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'kr',
            'deprecated' => false,
        ],
        'SGD' => [
            'display_name' => 'Singapore Dollar',
            'numeric_code' => 702,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'SHP' => [
            'display_name' => 'Saint Helena Pound',
            'numeric_code' => 654,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '£',
            'deprecated' => false,
        ],
        'SLL' => [
            'display_name' => 'Leone',
            'numeric_code' => 694,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Le',
            'deprecated' => false,
        ],
        'SOS' => [
            'display_name' => 'Somali Shilling',
            'numeric_code' => 706,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'S',
            'deprecated' => false,
        ],
        'SRD' => [
            'display_name' => 'Surinam Dollar',
            'numeric_code' => 968,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'SSP' => [
            'display_name' => 'South Sudanese Pound',
            'numeric_code' => 728,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '£',
            'deprecated' => false,
        ],
        'STN' => [
            'display_name' => 'Dobra',
            'numeric_code' => 930,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Db',
            'deprecated' => false,
        ],
        'STD' => [
            'display_name' => 'Dobra',
            'numeric_code' => 678,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Db',
            'deprecated' => true,
        ],
        'SVC' => [
            'display_name' => 'El Salvador Colon',
            'numeric_code' => 222,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₡',
            'deprecated' => false,
        ],
        'SYP' => [
            'display_name' => 'Syrian Pound',
            'numeric_code' => 760,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '£',
            'deprecated' => false,
        ],
        'SZL' => [
            'display_name' => 'Lilangeni',
            'numeric_code' => 748,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'L',
            'deprecated' => false,
        ],
        'THB' => [
            'display_name' => 'Baht',
            'numeric_code' => 764,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '฿',
            'deprecated' => false,
        ],
        'TJS' => [
            'display_name' => 'Somoni',
            'numeric_code' => 972,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'SM',
            'deprecated' => false,
        ],
        'TMT' => [
            'display_name' => 'Turkmenistan New Manat',
            'numeric_code' => 934,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'TMT',
            'deprecated' => false,
        ],
        'TND' => [
            'display_name' => 'Tunisian Dinar',
            'numeric_code' => 788,
            'default_fraction_digits' => 3,
            'sub_unit' => 1000,
            'sign' => 'د.ت',
            'deprecated' => false,
        ],
        'TOP' => [
            'display_name' => 'Pa’anga',
            'numeric_code' => 776,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'TRY' => [
            'display_name' => 'Turkish Lira',
            'numeric_code' => 949,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₺',
            'deprecated' => false,
        ],
        'TTD' => [
            'display_name' => 'Trinidad and Tobago Dollar',
            'numeric_code' => 780,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'TWD' => [
            'display_name' => 'New Taiwan Dollar',
            'numeric_code' => 901,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'TZS' => [
            'display_name' => 'Tanzanian Shilling',
            'numeric_code' => 834,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Sh',
            'deprecated' => false,
        ],
        'UAH' => [
            'display_name' => 'Hryvnia',
            'numeric_code' => 980,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₴',
            'deprecated' => false,
        ],
        'UGX' => [
            'display_name' => 'Uganda Shilling',
            'numeric_code' => 800,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'Ush',
            'deprecated' => false,
        ],
        'USD' => [
            'display_name' => 'US Dollar',
            'numeric_code' => 840,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'USN' => [
            'display_name' => 'US Dollar (Next day)',
            'numeric_code' => 997,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'USS' => [
            'display_name' => 'US Dollar (Same day)',
            'numeric_code' => 998,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => true,
        ],
        'UYI' => [
            'display_name' => 'Uruguay Peso en Unidades Indexadas (URUIURUI)',
            'numeric_code' => 940,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'UYI',
            'deprecated' => false,
        ],
        'UYU' => [
            'display_name' => 'Peso Uruguayo',
            'numeric_code' => 858,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$U',
            'deprecated' => false,
        ],
        'UYW' => [
            'display_name' => 'Unidad Previsional',
            'numeric_code' => 927,
            'default_fraction_digits' => 4,
            'sub_unit' => 10000,
            'sign' => 'UP',
            'deprecated' => false,
        ],
        'UZS' => [
            'display_name' => 'Uzbekistan Sum',
            'numeric_code' => 860,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 's\'om',
            'deprecated' => false,
        ],
        'VES' => [
            'display_name' => 'Bolivar Soberano',
            'numeric_code' => 928,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Bs.S.',
            'deprecated' => false,
        ],
        'VEF' => [
            'display_name' => 'Bolivar',
            'numeric_code' => 937,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Bs.F.',
            'deprecated' => true,
        ],
        'VND' => [
            'display_name' => 'Dong',
            'numeric_code' => 704,
            'default_fraction_digits' => 0,
            'sub_unit' => 10,
            'sign' => '₫',
            'deprecated' => false,
        ],
        'VUV' => [
            'display_name' => 'Vatu',
            'numeric_code' => 548,
            'default_fraction_digits' => 0,
            'sub_unit' => 1,
            'sign' => 'VT',
            'deprecated' => false,
        ],
        'WST' => [
            'display_name' => 'Tala',
            'numeric_code' => 882,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'XAF' => [
            'display_name' => 'CFA Franc BEAC',
            'numeric_code' => 950,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'FCFA',
            'deprecated' => false,
        ],
        'XAG' => [
            'display_name' => 'Silver',
            'numeric_code' => 961,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'Ag',
            'deprecated' => false,
        ],
        'XAU' => [
            'display_name' => 'Gold',
            'numeric_code' => 959,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'Au',
            'deprecated' => false,
        ],
        'XBA' => [
            'display_name' => 'Bond Markets Unit European Composite Unit (EURCO)',
            'numeric_code' => 955,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'XBA',
            'deprecated' => false,
        ],
        'XBB' => [
            'display_name' => 'Bond Markets Unit European Monetary Unit (E.M.U.-6)',
            'numeric_code' => 956,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'XBB',
            'deprecated' => false,
        ],
        'XBC' => [
            'display_name' => 'Bond Markets Unit European Unit of Account 9 (E.U.A.-9)',
            'numeric_code' => 957,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'XBC',
            'deprecated' => false,
        ],
        'XBD' => [
            'display_name' => 'Bond Markets Unit European Unit of Account 17 (E.U.A.-17)',
            'numeric_code' => 958,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'XBD',
            'deprecated' => false,
        ],
        'XCD' => [
            'display_name' => 'East Caribbean Dollar',
            'numeric_code' => 951,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
            'deprecated' => false,
        ],
        'XDR' => [
            'display_name' => 'SDR (Special Drawing Right)',
            'numeric_code' => 960,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'XDR',
            'deprecated' => false,
        ],
        'XFU' => [
            'display_name' => 'UIC-Franc',
            'numeric_code' => 958,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'XFU',
            'deprecated' => true,
        ],
        'XOF' => [
            'display_name' => 'CFA Franc BCEAO',
            'numeric_code' => 952,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'CFA',
            'deprecated' => false,
        ],
        'XPD' => [
            'display_name' => 'Palladium',
            'numeric_code' => 964,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'Pd',
            'deprecated' => false,
        ],
        'XPF' => [
            'display_name' => 'CFP Franc',
            'numeric_code' => 953,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'F',
            'deprecated' => false,
        ],
        'XPT' => [
            'display_name' => 'Platinum',
            'numeric_code' => 962,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'Pt',
            'deprecated' => false,
        ],
        'XSU' => [
            'display_name' => 'Sucre',
            'numeric_code' => 994,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'XSU',
            'deprecated' => false,
        ],
        'XTS' => [
            'display_name' => 'Codes specifically reserved for testing purposes',
            'numeric_code' => 963,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'XTS',
            'deprecated' => false,
        ],
        'XUA' => [
            'display_name' => 'ADB Unit of Account',
            'numeric_code' => 965,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'XUA',
            'deprecated' => false,
        ],
        'XXX' => [
            'display_name' => 'The codes assigned for transactions where no currency is involved',
            'numeric_code' => 999,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'XXX',
            'deprecated' => false,
        ],
        'YER' => [
            'display_name' => 'Yemeni Rial',
            'numeric_code' => 886,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '﷼',
            'deprecated' => false,
        ],
        'ZAR' => [
            'display_name' => 'Rand',
            'numeric_code' => 710,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'R',
            'deprecated' => false,
        ],
        'ZMW' => [
            'display_name' => 'Zambian Kwacha',
            'numeric_code' => 967,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'ZK',
            'deprecated' => false,
        ],
        'ZWL' => [
            'display_name' => 'Zimbabwe Dollar',
            'numeric_code' => 932,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'ZWL',
            'deprecated' => false,
        ],
    ];

    /**
     * @var string
     */
    private $currencyCode;

    public function __construct(string $currencyCode)
    {
        $currencyCode = mb_strtoupper($currencyCode);

        if (!isset(self::$currencies[$currencyCode])) {
            throw new InvalidArgumentException(sprintf('Unknown currency code "%s"', $currencyCode));
        }

        $this->currencyCode = $currencyCode;
    }

    /**
     * Returns the ISO 4217 currency code of this currency.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getCurrencyCode();
    }

    public static function fromNumericCode(int $code): self
    {
        /** @var string[] $map */
        $map = array_combine(
            array_column(self::getCurrenciesIncludingDeprecated(), 'numeric_code'),
            array_keys(self::getCurrenciesIncludingDeprecated())
        );

        if (!isset($map[$code])) {
            throw new InvalidArgumentException(sprintf('Unknown currency code "%d"', $code));
        }

        return new self($map[$code]);
    }

    public static function addCurrency(
        string $code,
        string $displayName,
        int $numericCode,
        int $defaultFractionDigits,
        int $subUnit,
        bool $deprecated = false
    ): void {
        self::$currencies[$code] = [
            'display_name' => $displayName,
            'numeric_code' => $numericCode,
            'default_fraction_digits' => $defaultFractionDigits,
            'sub_unit' => $subUnit,
            'sign' => '',
            'deprecated' => $deprecated,
        ];
    }

    /**
     * Returns only active currencies.
     *
     * @return array<string, array{display_name: string, numeric_code: int, default_fraction_digits: int, sub_unit: int, sign: string, deprecated: boolean}>
     */
    public static function getCurrencies(): array
    {
        return array_filter(
            self::$currencies,
            static function (array $currency): bool {
                return !$currency['deprecated'];
            }
        );
    }

    /**
     * Returns all currencies: active and deprecated.
     *
     * @return array<string, array{display_name: string, numeric_code: int, default_fraction_digits: int, sub_unit: int, sign: string, deprecated: boolean}>
     */
    public static function getCurrenciesIncludingDeprecated(): array
    {
        return self::$currencies;
    }

    /**
     * Returns the ISO 4217 currency code of this currency.
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    /**
     * Returns the default number of fraction digits used with this
     * currency.
     */
    public function getDefaultFractionDigits(): int
    {
        return self::$currencies[$this->getCurrencyCode()]['default_fraction_digits'];
    }

    /**
     * Returns the name that is suitable for displaying this currency.
     */
    public function getDisplayName(): string
    {
        return self::$currencies[$this->getCurrencyCode()]['display_name'];
    }

    /**
     * Returns the ISO 4217 numeric code of this currency.
     */
    public function getNumericCode(): int
    {
        return self::$currencies[$this->getCurrencyCode()]['numeric_code'];
    }

    /**
     * Returns the minor currency sub units.
     */
    public function getSubUnit(): int
    {
        return self::$currencies[$this->getCurrencyCode()]['sub_unit'];
    }

    /**
     * Returns the currency sign.
     */
    public function getSign(): string
    {
        return self::$currencies[$this->getCurrencyCode()]['sign'];
    }

    /**
     * Returns the deprecation status.
     */
    public function isDeprecated(): bool
    {
        return self::$currencies[$this->getCurrencyCode()]['deprecated'];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): string
    {
        return $this->getCurrencyCode();
    }

    public function equals(self $currency): bool
    {
        return $this->getCurrencyCode() === $currency->getCurrencyCode();
    }
}
