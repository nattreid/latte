<?php

declare(strict_types=1);

namespace NAttreid\Latte;

use Datetime;
use NAttreid\Utils\Date;
use NAttreid\Utils\Number;
use Nette\InvalidArgumentException;
use Nette\Utils\Json;

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
	 * Zpracuje cislo
	 * @param float|string|null $number
	 * @return float
	 */
	private static function prepareFloat($number): float
	{
		if ($number === null) {
			return 0;
		} elseif (is_numeric($number)) {
			return (float) $number;
		} else {
			throw new InvalidArgumentException("Value must be a number");
		}
	}

	/**
	 * Vrati zformatovane cislo
	 * @param float|string|null $number
	 * @param int $decimal
	 * @return string
	 */
	private static function localeNumber($number, int $decimal = 2): string
	{
		return Number::getNumber(self::prepareFloat($number), $decimal);
	}

	/**
	 * Procenta
	 * @param float|string|null $number
	 * @param float $total
	 * @param int $decimal
	 * @return string
	 */
	private static function percent($number, float $total, int $decimal = 2): string
	{
		return Number::percent(self::prepareFloat($number), $total, $decimal);
	}

	/**
	 * Frekvence
	 * @param float|string|null $number
	 * @return string
	 */
	private static function frequency($number): string
	{
		return Number::frequency(self::prepareFloat($number));
	}

	/**
	 * Velikost souboru
	 * @param float|string|null $number
	 * @param int $decimal
	 * @param bool $binary
	 * @return string
	 */
	private static function size($number, int $decimal = 2, bool $binary = false)
	{
		return Number::size(self::prepareFloat($number), $decimal, $binary);
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

	/**
	 * Prevede vstup do JSON
	 * @param mixed $obj
	 * @return string
	 */
	private static function json($obj): string
	{
		return Json::encode($obj);
	}
}
