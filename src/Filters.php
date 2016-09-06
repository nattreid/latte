<?php

namespace NAttreid\Latte;

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
	public static function common($filter, ...$value)
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
	private static function localeNumber($number, $decimal = 2)
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
	private static function percent($number, $total, $decimal = 2)
	{
		return Number::percent($number, $total, $decimal);
	}

	/**
	 * Frekvence
	 * @param float $number
	 * @return string
	 */
	private static function frequency($number)
	{
		return Number::frequency($number);
	}

	/**
	 * Velikost souboru
	 * @param float $number
	 * @param int $decimal
	 * @param boolean $binary
	 * @return string
	 */
	private static function size($number, $decimal = 2, $binary = FALSE)
	{
		return Number::size($number, $decimal, $binary);
	}

	/**
	 * Lokalizovane datum s casem
	 * @param \Datetime|int $datetime
	 * @return string
	 */
	private static function localeDateTime($datetime)
	{
		return Date::getDateTime($datetime);
	}

	/**
	 * Lokalizovane datum
	 * @param \Datetime|int $datetime
	 * @return string
	 */
	private static function localeDate($datetime)
	{
		return Date::getDate($datetime);
	}

	/**
	 * Vrati nazev dne
	 * @param int $day
	 * @return string
	 */
	private static function day($day)
	{
		return Date::getDay($day);
	}

	/**
	 * Vrati zkraceny nazev dne
	 * @param int $day
	 * @return string
	 */
	private static function shortDay($day)
	{
		return Date::getShortDay($day);
	}

	/**
	 * Vrati nazev mesice
	 * @param int $month
	 * @return string
	 */
	private static function month($month)
	{
		return Date::getMonth($month);
	}

	/**
	 * Vrati zkraceny nazev mesice
	 * @param int $month
	 * @return string
	 */
	private static function shortMonth($month)
	{
		return Date::getShortMonth($month);
	}

}
