<?php

declare(strict_types=1);

namespace NAttreid\Latte;

use Datetime;
use NAttreid\Utils\Date;
use NAttreid\Utils\Number;

/**
 * Filtry pro latte
 *
 * @author Attreid <attreid@gmail.com>
 */
class Filters
{

	/**
	 * Nastaveni
	 * @param string $filter
	 * @param mixed $value
	 * @return mixed
	 */
	public static function common(string $filter, ...$value)
	{
		if (method_exists(__CLASS__, $filter)) {
			return self::$filter(...$value);
		}
	}

	/**
	 * Vrati zformatovane cislo
	 * @param float $number
	 * @param int $decimal
	 * @return string
	 */
	private static function localeNumber(float $number, int $decimal = 2): string
	{
		return Number::getNumber($number, $decimal);
	}

	/**
	 * Procenta
	 * @param float $number
	 * @param float $total
	 * @param int $decimal
	 * @return string
	 */
	private static function percent(float $number, float $total, int $decimal = 2): string
	{
		return Number::percent($number, $total, $decimal);
	}

	/**
	 * Frekvence
	 * @param float $number
	 * @return string
	 */
	private static function frequency(float $number): string
	{
		return Number::frequency($number);
	}

	/**
	 * Velikost souboru
	 * @param float $number
	 * @param int $decimal
	 * @param bool $binary
	 * @return string
	 */
	private static function size(float $number, int $decimal = 2, bool $binary = false)
	{
		return Number::size($number, $decimal, $binary);
	}

	/**
	 * Lokalizovane datum s casem
	 * @param Datetime|int $datetime
	 * @return string
	 */
	private static function localeDateTime($datetime): string
	{
		return Date::getDateTime($datetime);
	}

	/**
	 * Lokalizovane datum s casem bez sekund
	 * @param Datetime|int $datetime
	 * @return string
	 */
	private static function localeDateWithTime($datetime): string
	{
		return Date::getDateWithTime($datetime);
	}

	/**
	 * Lokalizovane datum
	 * @param Datetime|int $datetime
	 * @return string
	 */
	private static function localeDate($datetime): string
	{
		return Date::getDate($datetime);
	}

	/**
	 * Vrati nazev dne
	 * @param int|Datetime $day
	 * @return string
	 */
	private static function day($day): string
	{
		return Date::getDay($day);
	}

	/**
	 * Vrati zkraceny nazev dne
	 * @param int|Datetime $day
	 * @return string
	 */
	private static function shortDay($day): string
	{
		return Date::getShortDay($day);
	}

	/**
	 * Vrati nazev mesice
	 * @param int|Datetime $month
	 * @return string
	 */
	private static function month($month): string
	{
		return Date::getMonth($month);
	}

	/**
	 * Vrati zkraceny nazev mesice
	 * @param int|Datetime $month
	 * @return string
	 */
	private static function shortMonth($month): string
	{
		return Date::getShortMonth($month);
	}

}
