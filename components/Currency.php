<?php
namespace app\components;

use Yii;

class Currency extends \yii\base\Object {

	///Переменная, для хранения текущего объекта валюты
	public static $current = null;

	//Получение текущего объекта валюты
	public static function getCurrent() {
		if (self::$current === null) {
			self::$current = self::getDefaultCurrency();
		}

		return self::$current;
	}

	//Установка текущей валюты
	public static function setCurrent($currency = null) {
		$currency = strtoupper($currency);
		$allCurrency = self::getAllCurrency();
		self::$current = (isset($allCurrency[$currency])) ? $currency : self::getDefaultCurrency();
		Yii::$app->params['defaultCurrency'] = self::$current;
	}

	//Получения валюты по умолчанию
	public static function getDefaultCurrency() {
		return Yii::$app->params['defaultCurrency'];
	}

	//Получения всех валют
	public static function getAllCurrency() {
		return [
			'USD' => '$',
			'RUB' => 'руб',
			'EUR' => 'eur',
			'UAH' => 'грн',
		];
	}

	public static function getAllCurrencyFullName() {
		return [
			'USD' => 'доллар США',
			'RUB' => 'рос. рубль',
			'EUR' => 'ЕВРО',
			'UAH' => 'укр. гривна',
		];
	}
}