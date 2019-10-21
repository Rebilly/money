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
     * @var array
     */
    private static $currencies = [
        'AED' => [
            'display_name' => 'UAE Dirham',
            'numeric_code' => 784,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'د.إ',
        ],
        'AFN' => [
            'display_name' => 'Afghani',
            'numeric_code' => 971,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '؋',
        ],
        'ALL' => [
            'display_name' => 'Lek',
            'numeric_code' => 8,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'L',
        ],
        'AMD' => [
            'display_name' => 'Armenian Dram',
            'numeric_code' => 51,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '֏',
        ],
        'ANG' => [
            'display_name' => 'Netherlands Antillean Guilder',
            'numeric_code' => 532,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'ƒ',
        ],
        'AOA' => [
            'display_name' => 'Kwanza',
            'numeric_code' => 973,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Kz',
        ],
        'ARS' => [
            'display_name' => 'Argentine Peso',
            'numeric_code' => 32,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'AUD' => [
            'display_name' => 'Australian Dollar',
            'numeric_code' => 36,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'AWG' => [
            'display_name' => 'Aruban Florin',
            'numeric_code' => 533,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'ƒ',
        ],
        'AZN' => [
            'display_name' => 'Azerbaijanian Manat',
            'numeric_code' => 944,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'm',
        ],
        'BAM' => [
            'display_name' => 'Convertible Mark',
            'numeric_code' => 977,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'KM',
        ],
        'BBD' => [
            'display_name' => 'Barbados Dollar',
            'numeric_code' => 52,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'BDT' => [
            'display_name' => 'Taka',
            'numeric_code' => 50,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '৳',
        ],
        'BGN' => [
            'display_name' => 'Bulgarian Lev',
            'numeric_code' => 975,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'лв',
        ],
        'BHD' => [
            'display_name' => 'Bahraini Dinar',
            'numeric_code' => 48,
            'default_fraction_digits' => 3,
            'sub_unit' => 1000,
            'sign' => '.د.ب',
        ],
        'BIF' => [
            'display_name' => 'Burundi Franc',
            'numeric_code' => 108,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'FBu',
        ],
        'BMD' => [
            'display_name' => 'Bermudian Dollar',
            'numeric_code' => 60,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'BND' => [
            'display_name' => 'Brunei Dollar',
            'numeric_code' => 96,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'BOB' => [
            'display_name' => 'Boliviano',
            'numeric_code' => 68,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$b',
        ],
        'BOV' => [
            'display_name' => 'Mvdol',
            'numeric_code' => 984,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'BOV',
        ],
        'BRL' => [
            'display_name' => 'Brazilian Real',
            'numeric_code' => 986,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'R$',
        ],
        'BSD' => [
            'display_name' => 'Bahamian Dollar',
            'numeric_code' => 44,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'BTN' => [
            'display_name' => 'Ngultrum',
            'numeric_code' => 64,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Nu.',
        ],
        'BWP' => [
            'display_name' => 'Pula',
            'numeric_code' => 72,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'P',
        ],
        'BYN' => [
            'display_name' => 'Belarussian Ruble',
            'numeric_code' => 933,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Br',
        ],
        'BZD' => [
            'display_name' => 'Belize Dollar',
            'numeric_code' => 84,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'CAD' => [
            'display_name' => 'Canadian Dollar',
            'numeric_code' => 124,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'CDF' => [
            'display_name' => 'Congolese Franc',
            'numeric_code' => 976,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'FC',
        ],
        'CHE' => [
            'display_name' => 'WIR Euro',
            'numeric_code' => 947,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'CHE',
        ],
        'CHF' => [
            'display_name' => 'Swiss Franc',
            'numeric_code' => 756,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'CHF',
        ],
        'CHW' => [
            'display_name' => 'WIR Franc',
            'numeric_code' => 948,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'CHW',
        ],
        'CLF' => [
            'display_name' => 'Unidades de fomento',
            'numeric_code' => 990,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'UF',
        ],
        'CLP' => [
            'display_name' => 'Chilean Peso',
            'numeric_code' => 152,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'CNY' => [
            'display_name' => 'Yuan Renminbi',
            'numeric_code' => 156,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '¥',
        ],
        'COP' => [
            'display_name' => 'Colombian Peso',
            'numeric_code' => 170,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'COU' => [
            'display_name' => 'Unidad de Valor Real',
            'numeric_code' => 970,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'COU',
        ],
        'CRC' => [
            'display_name' => 'Costa Rican Colon',
            'numeric_code' => 188,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₡',
        ],
        'CUC' => [
            'display_name' => 'Peso Convertible',
            'numeric_code' => 931,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'CUP' => [
            'display_name' => 'Cuban Peso',
            'numeric_code' => 192,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₱',
        ],
        'CVE' => [
            'display_name' => 'Cape Verde Escudo',
            'numeric_code' => 132,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'CZK' => [
            'display_name' => 'Czech Koruna',
            'numeric_code' => 203,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Kč',
        ],
        'DJF' => [
            'display_name' => 'Djibouti Franc',
            'numeric_code' => 262,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'Fdj',
        ],
        'DKK' => [
            'display_name' => 'Danish Krone',
            'numeric_code' => 208,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'kr.',
        ],
        'DOP' => [
            'display_name' => 'Dominican Peso',
            'numeric_code' => 214,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'RD$',
        ],
        'DZD' => [
            'display_name' => 'Algerian Dinar',
            'numeric_code' => 12,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'دج',
        ],
        'EGP' => [
            'display_name' => 'Egyptian Pound',
            'numeric_code' => 818,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '£',
        ],
        'ERN' => [
            'display_name' => 'Nakfa',
            'numeric_code' => 232,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Nfk',
        ],
        'ETB' => [
            'display_name' => 'Ethiopian Birr',
            'numeric_code' => 230,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Br',
        ],
        'EUR' => [
            'display_name' => 'Euro',
            'numeric_code' => 978,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '€',
        ],
        'FJD' => [
            'display_name' => 'Fiji Dollar',
            'numeric_code' => 242,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'FKP' => [
            'display_name' => 'Falkland Islands Pound',
            'numeric_code' => 238,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '£',
        ],
        'GBP' => [
            'display_name' => 'Pound Sterling',
            'numeric_code' => 826,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '£',
        ],
        'GEL' => [
            'display_name' => 'Lari',
            'numeric_code' => 981,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'ლ',
        ],
        'GHS' => [
            'display_name' => 'Ghana Cedi',
            'numeric_code' => 936,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '¢',
        ],
        'GIP' => [
            'display_name' => 'Gibraltar Pound',
            'numeric_code' => 292,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '£',
        ],
        'GMD' => [
            'display_name' => 'Dalasi',
            'numeric_code' => 270,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'D',
        ],
        'GNF' => [
            'display_name' => 'Guinea Franc',
            'numeric_code' => 324,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'FG',
        ],
        'GTQ' => [
            'display_name' => 'Quetzal',
            'numeric_code' => 320,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Q',
        ],
        'GYD' => [
            'display_name' => 'Guyana Dollar',
            'numeric_code' => 328,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'HKD' => [
            'display_name' => 'Hong Kong Dollar',
            'numeric_code' => 344,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'HNL' => [
            'display_name' => 'Lempira',
            'numeric_code' => 340,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'L',
        ],
        'HRK' => [
            'display_name' => 'Croatian Kuna',
            'numeric_code' => 191,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'kn',
        ],
        'HTG' => [
            'display_name' => 'Gourde',
            'numeric_code' => 332,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'G',
        ],
        'HUF' => [
            'display_name' => 'Forint',
            'numeric_code' => 348,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Ft',
        ],
        'IDR' => [
            'display_name' => 'Rupiah',
            'numeric_code' => 360,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Rp',
        ],
        'ILS' => [
            'display_name' => 'New Israeli Sheqel',
            'numeric_code' => 376,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₪',
        ],
        'INR' => [
            'display_name' => 'Indian Rupee',
            'numeric_code' => 356,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₹',
        ],
        'IQD' => [
            'display_name' => 'Iraqi Dinar',
            'numeric_code' => 368,
            'default_fraction_digits' => 3,
            'sub_unit' => 1000,
            'sign' => 'ع.د',
        ],
        'IRR' => [
            'display_name' => 'Iranian Rial',
            'numeric_code' => 364,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '﷼',
        ],
        'ISK' => [
            'display_name' => 'Iceland Krona',
            'numeric_code' => 352,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'kr',
        ],
        'JMD' => [
            'display_name' => 'Jamaican Dollar',
            'numeric_code' => 388,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'JOD' => [
            'display_name' => 'Jordanian Dinar',
            'numeric_code' => 400,
            'default_fraction_digits' => 3,
            'sub_unit' => 100,
            'sign' => 'د.ا',
        ],
        'JPY' => [
            'display_name' => 'Yen',
            'numeric_code' => 392,
            'default_fraction_digits' => 0,
            'sub_unit' => 1,
            'sign' => '¥',
        ],
        'KES' => [
            'display_name' => 'Kenyan Shilling',
            'numeric_code' => 404,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Sh',
        ],
        'KGS' => [
            'display_name' => 'Som',
            'numeric_code' => 417,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'сом',
        ],
        'KHR' => [
            'display_name' => 'Riel',
            'numeric_code' => 116,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '៛',
        ],
        'KMF' => [
            'display_name' => 'Comoro Franc',
            'numeric_code' => 174,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'CF',
        ],
        'KPW' => [
            'display_name' => 'North Korean Won',
            'numeric_code' => 408,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₩',
        ],
        'KRW' => [
            'display_name' => 'Won',
            'numeric_code' => 410,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => '₩',
        ],
        'KWD' => [
            'display_name' => 'Kuwaiti Dinar',
            'numeric_code' => 414,
            'default_fraction_digits' => 3,
            'sub_unit' => 1000,
            'sign' => 'د.ك',
        ],
        'KYD' => [
            'display_name' => 'Cayman Islands Dollar',
            'numeric_code' => 136,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'KZT' => [
            'display_name' => 'Tenge',
            'numeric_code' => 398,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₸',
        ],
        'LAK' => [
            'display_name' => 'Kip',
            'numeric_code' => 418,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₭',
        ],
        'LBP' => [
            'display_name' => 'Lebanese Pound',
            'numeric_code' => 422,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '£',
        ],
        'LKR' => [
            'display_name' => 'Sri Lanka Rupee',
            'numeric_code' => 144,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₨',
        ],
        'LRD' => [
            'display_name' => 'Liberian Dollar',
            'numeric_code' => 430,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'LSL' => [
            'display_name' => 'Loti',
            'numeric_code' => 426,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'L',
        ],
        'LYD' => [
            'display_name' => 'Libyan Dinar',
            'numeric_code' => 434,
            'default_fraction_digits' => 3,
            'sub_unit' => 1000,
            'sign' => 'ل.د',
        ],
        'MAD' => [
            'display_name' => 'Moroccan Dirham',
            'numeric_code' => 504,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'د.م.',
        ],
        'MDL' => [
            'display_name' => 'Moldovan Leu',
            'numeric_code' => 498,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'MDL',
        ],
        'MGA' => [
            'display_name' => 'Malagasy Ariary',
            'numeric_code' => 969,
            'default_fraction_digits' => 2,
            'sub_unit' => 5,
            'sign' => 'Ar',
        ],
        'MKD' => [
            'display_name' => 'Denar',
            'numeric_code' => 807,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'ден',
        ],
        'MMK' => [
            'display_name' => 'Kyat',
            'numeric_code' => 104,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'K',
        ],
        'MNT' => [
            'display_name' => 'Tugrik',
            'numeric_code' => 496,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₮',
        ],
        'MOP' => [
            'display_name' => 'Pataca',
            'numeric_code' => 446,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'P',
        ],
        'MRU' => [
            'display_name' => 'Ouguiya',
            'numeric_code' => 929,
            'default_fraction_digits' => 2,
            'sub_unit' => 5,
            'sign' => 'UM',
        ],
        'MUR' => [
            'display_name' => 'Mauritius Rupee',
            'numeric_code' => 480,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₨',
        ],
        'MVR' => [
            'display_name' => 'Rufiyaa',
            'numeric_code' => 462,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Rf',
        ],
        'MWK' => [
            'display_name' => 'Kwacha',
            'numeric_code' => 454,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'MK',
        ],
        'MXN' => [
            'display_name' => 'Mexican Peso',
            'numeric_code' => 484,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'MXV' => [
            'display_name' => 'Mexican Unidad de Inversion (UDI)',
            'numeric_code' => 979,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'MXV',
        ],
        'MYR' => [
            'display_name' => 'Malaysian Ringgit',
            'numeric_code' => 458,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'RM',
        ],
        'MZN' => [
            'display_name' => 'Mozambique Metical',
            'numeric_code' => 943,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'MT',
        ],
        'NAD' => [
            'display_name' => 'Namibia Dollar',
            'numeric_code' => 516,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'NGN' => [
            'display_name' => 'Naira',
            'numeric_code' => 566,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₦',
        ],
        'NIO' => [
            'display_name' => 'Cordoba Oro',
            'numeric_code' => 558,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'NOK' => [
            'display_name' => 'Norwegian Krone',
            'numeric_code' => 578,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'kr',
        ],
        'NPR' => [
            'display_name' => 'Nepalese Rupee',
            'numeric_code' => 524,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₨',
        ],
        'NZD' => [
            'display_name' => 'New Zealand Dollar',
            'numeric_code' => 554,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'OMR' => [
            'display_name' => 'Rial Omani',
            'numeric_code' => 512,
            'default_fraction_digits' => 3,
            'sub_unit' => 1000,
            'sign' => '﷼',
        ],
        'PAB' => [
            'display_name' => 'Balboa',
            'numeric_code' => 590,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'B/.',
        ],
        'PEN' => [
            'display_name' => 'Nuevo Sol',
            'numeric_code' => 604,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'S/.',
        ],
        'PGK' => [
            'display_name' => 'Kina',
            'numeric_code' => 598,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'K',
        ],
        'PHP' => [
            'display_name' => 'Philippine Peso',
            'numeric_code' => 608,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₱',
        ],
        'PKR' => [
            'display_name' => 'Pakistan Rupee',
            'numeric_code' => 586,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₨',
        ],
        'PLN' => [
            'display_name' => 'Zloty',
            'numeric_code' => 985,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'zł',
        ],
        'PYG' => [
            'display_name' => 'Guarani',
            'numeric_code' => 600,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => '₲',
        ],
        'QAR' => [
            'display_name' => 'Qatari Rial',
            'numeric_code' => 634,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '﷼',
        ],
        'RON' => [
            'display_name' => 'New Romanian Leu',
            'numeric_code' => 946,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'lei',
        ],
        'RSD' => [
            'display_name' => 'Serbian Dinar',
            'numeric_code' => 941,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'дин.',
        ],
        'RUB' => [
            'display_name' => 'Russian Ruble',
            'numeric_code' => 643,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₽',
        ],
        'RWF' => [
            'display_name' => 'Rwanda Franc',
            'numeric_code' => 646,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'FRw',
        ],
        'SAR' => [
            'display_name' => 'Saudi Riyal',
            'numeric_code' => 682,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '﷼',
        ],
        'SBD' => [
            'display_name' => 'Solomon Islands Dollar',
            'numeric_code' => 90,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'SCR' => [
            'display_name' => 'Seychelles Rupee',
            'numeric_code' => 690,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'SR',
        ],
        'SDG' => [
            'display_name' => 'Sudanese Pound',
            'numeric_code' => 938,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '£',
        ],
        'SEK' => [
            'display_name' => 'Swedish Krona',
            'numeric_code' => 752,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'kr',
        ],
        'SGD' => [
            'display_name' => 'Singapore Dollar',
            'numeric_code' => 702,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'SHP' => [
            'display_name' => 'Saint Helena Pound',
            'numeric_code' => 654,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '£',
        ],
        'SLL' => [
            'display_name' => 'Leone',
            'numeric_code' => 694,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Le',
        ],
        'SOS' => [
            'display_name' => 'Somali Shilling',
            'numeric_code' => 706,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'S',
        ],
        'SRD' => [
            'display_name' => 'Surinam Dollar',
            'numeric_code' => 968,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'SSP' => [
            'display_name' => 'South Sudanese Pound',
            'numeric_code' => 728,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '£',
        ],
        'STN' => [
            'display_name' => 'Dobra',
            'numeric_code' => 930,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Db',
        ],
        'SVC' => [
            'display_name' => 'El Salvador Colon',
            'numeric_code' => 222,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₡',
        ],
        'SYP' => [
            'display_name' => 'Syrian Pound',
            'numeric_code' => 760,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '£',
        ],
        'SZL' => [
            'display_name' => 'Lilangeni',
            'numeric_code' => 748,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'L',
        ],
        'THB' => [
            'display_name' => 'Baht',
            'numeric_code' => 764,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '฿',
        ],
        'TJS' => [
            'display_name' => 'Somoni',
            'numeric_code' => 972,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'SM',
        ],
        'TMT' => [
            'display_name' => 'Turkmenistan New Manat',
            'numeric_code' => 934,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'TMT',
        ],
        'TND' => [
            'display_name' => 'Tunisian Dinar',
            'numeric_code' => 788,
            'default_fraction_digits' => 3,
            'sub_unit' => 1000,
            'sign' => 'د.ت',
        ],
        'TOP' => [
            'display_name' => 'Pa’anga',
            'numeric_code' => 776,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'TRY' => [
            'display_name' => 'Turkish Lira',
            'numeric_code' => 949,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₺',
        ],
        'TTD' => [
            'display_name' => 'Trinidad and Tobago Dollar',
            'numeric_code' => 780,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'TWD' => [
            'display_name' => 'New Taiwan Dollar',
            'numeric_code' => 901,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'TZS' => [
            'display_name' => 'Tanzanian Shilling',
            'numeric_code' => 834,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Sh',
        ],
        'UAH' => [
            'display_name' => 'Hryvnia',
            'numeric_code' => 980,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '₴',
        ],
        'UGX' => [
            'display_name' => 'Uganda Shilling',
            'numeric_code' => 800,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'Ush',
        ],
        'USD' => [
            'display_name' => 'US Dollar',
            'numeric_code' => 840,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'USN' => [
            'display_name' => 'US Dollar (Next day)',
            'numeric_code' => 997,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'UYI' => [
            'display_name' => 'Uruguay Peso en Unidades Indexadas (URUIURUI)',
            'numeric_code' => 940,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'UYI',
        ],
        'UYU' => [
            'display_name' => 'Peso Uruguayo',
            'numeric_code' => 858,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$U',
        ],
        'UYW' => [
            'display_name' => 'Unidad Previsional',
            'numeric_code' => 927,
            'default_fraction_digits' => 4,
            'sub_unit' => 10000,
            'sign' => 'UP',
        ],
        'UZS' => [
            'display_name' => 'Uzbekistan Sum',
            'numeric_code' => 860,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 's\'om',
        ],
        'VES' => [
            'display_name' => 'Bolivar Soberano',
            'numeric_code' => 928,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'Bs.S.',
        ],
        'VND' => [
            'display_name' => 'Dong',
            'numeric_code' => 704,
            'default_fraction_digits' => 0,
            'sub_unit' => 10,
            'sign' => '₫',
        ],
        'VUV' => [
            'display_name' => 'Vatu',
            'numeric_code' => 548,
            'default_fraction_digits' => 0,
            'sub_unit' => 1,
            'sign' => 'VT',
        ],
        'WST' => [
            'display_name' => 'Tala',
            'numeric_code' => 882,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'XAF' => [
            'display_name' => 'CFA Franc BEAC',
            'numeric_code' => 950,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'FCFA',
        ],
        'XAG' => [
            'display_name' => 'Silver',
            'numeric_code' => 961,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'Ag',
        ],
        'XAU' => [
            'display_name' => 'Gold',
            'numeric_code' => 959,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'Au',
        ],
        'XBA' => [
            'display_name' => 'Bond Markets Unit European Composite Unit (EURCO)',
            'numeric_code' => 955,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'XBA',
        ],
        'XBB' => [
            'display_name' => 'Bond Markets Unit European Monetary Unit (E.M.U.-6)',
            'numeric_code' => 956,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'XBB',
        ],
        'XBC' => [
            'display_name' => 'Bond Markets Unit European Unit of Account 9 (E.U.A.-9)',
            'numeric_code' => 957,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'XBC',
        ],
        'XBD' => [
            'display_name' => 'Bond Markets Unit European Unit of Account 17 (E.U.A.-17)',
            'numeric_code' => 958,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'XBD',
        ],
        'XCD' => [
            'display_name' => 'East Caribbean Dollar',
            'numeric_code' => 951,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '$',
        ],
        'XDR' => [
            'display_name' => 'SDR (Special Drawing Right)',
            'numeric_code' => 960,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'XDR',
        ],
        'XOF' => [
            'display_name' => 'CFA Franc BCEAO',
            'numeric_code' => 952,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'CFA',
        ],
        'XPD' => [
            'display_name' => 'Palladium',
            'numeric_code' => 964,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'Pd',
        ],
        'XPF' => [
            'display_name' => 'CFP Franc',
            'numeric_code' => 953,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'F',
        ],
        'XPT' => [
            'display_name' => 'Platinum',
            'numeric_code' => 962,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'Pt',
        ],
        'XSU' => [
            'display_name' => 'Sucre',
            'numeric_code' => 994,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'XSU',
        ],
        'XTS' => [
            'display_name' => 'Codes specifically reserved for testing purposes',
            'numeric_code' => 963,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'XTS',
        ],
        'XUA' => [
            'display_name' => 'ADB Unit of Account',
            'numeric_code' => 965,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'XUA',
        ],
        'XXX' => [
            'display_name' => 'The codes assigned for transactions where no currency is involved',
            'numeric_code' => 999,
            'default_fraction_digits' => 0,
            'sub_unit' => 100,
            'sign' => 'XXX',
        ],
        'YER' => [
            'display_name' => 'Yemeni Rial',
            'numeric_code' => 886,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => '﷼',
        ],
        'ZAR' => [
            'display_name' => 'Rand',
            'numeric_code' => 710,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'R',
        ],
        'ZMW' => [
            'display_name' => 'Zambian Kwacha',
            'numeric_code' => 967,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'ZK',
        ],
        'ZWL' => [
            'display_name' => 'Zimbabwe Dollar',
            'numeric_code' => 932,
            'default_fraction_digits' => 2,
            'sub_unit' => 100,
            'sign' => 'ZWL',
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
            array_column(self::getCurrencies(), 'numeric_code'),
            array_keys(self::getCurrencies())
        );

        if (!isset($map[$code])) {
            throw new InvalidArgumentException(sprintf('Unknown currency code "%d"', $code));
        }

        return new self($map[$code]);
    }

    public static function addCurrency(string $code, string $displayName, int $numericCode, int $defaultFractionDigits, int $subUnit): void
    {
        self::$currencies[$code] = [
            'display_name' => $displayName,
            'numeric_code' => $numericCode,
            'default_fraction_digits' => $defaultFractionDigits,
            'sub_unit' => $subUnit,
        ];
    }

    public static function getCurrencies(): array
    {
        return self::$currencies;
    }

    /**
     * Returns the ISO 4217 currency code of this currency.
     *
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    /**
     * Returns the default number of fraction digits used with this
     * currency.
     *
     * @return int
     */
    public function getDefaultFractionDigits(): int
    {
        return self::$currencies[$this->getCurrencyCode()]['default_fraction_digits'];
    }

    /**
     * Returns the name that is suitable for displaying this currency.
     *
     * @return string
     */
    public function getDisplayName(): string
    {
        return self::$currencies[$this->getCurrencyCode()]['display_name'];
    }

    /**
     * Returns the ISO 4217 numeric code of this currency.
     *
     * @return int
     */
    public function getNumericCode(): int
    {
        return self::$currencies[$this->getCurrencyCode()]['numeric_code'];
    }

    /**
     * Returns the minor currency sub units.
     *
     * @return int
     */
    public function getSubUnit(): int
    {
        return self::$currencies[$this->getCurrencyCode()]['sub_unit'];
    }

    /**
     * Returns the currency sign.
     *
     * @return string
     */
    public function getSign(): string
    {
        return self::$currencies[$this->getCurrencyCode()]['sign'];
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
