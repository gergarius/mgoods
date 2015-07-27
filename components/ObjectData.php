<?php
namespace app\components;

use Yii;
use app\components\Lang;
use app\components\Data;
use app\components\Currency;

class ObjectData extends Data {

	//Переменная, для хранения текущего домена данных
	public static $current = null;

	//Получение текущего домена данных
	public static function getCurrent() {
		if (self::$current === null) {
			self::$current = self::getAllDataDomain();
		}

		return self::$current;
	}

	public static function getData($id) {
		return parent::getJson(self::getDataUrl($id));
	}

	//Установка текущего домена данных
	public static function setCurrentDomain() {
		$dataArray = self::getAllDataDomain();
		self::$current = isset($dataArray[Yii::$app->language]) ? $dataArray[Yii::$app->language] : self::getDefaultDataDomain();
	}

	//Получения домена данных по умолчанию
	public static function getDefaultDataDomain() {
		$dataArray = self::getAllDataDomain();

		return $dataArray[Yii::$app->params['defaultLang']];
	}

	public static function formatPrice($price) {
		return $price;

		return number_format($price, 2, '.', '');
	}

	public static function getIpAddress() {
		//check ip from share internet
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}

		return $ip;
	}

	//Получения всех доменов данных
	public static function getAllDataDomain() {
		return Yii::$app->params['DataDomain'];
	}

	//Получения ссылки данных
	public static function getDataUrl($id) {

		$currency = Currency::getCurrent();
		$currency = strtolower($currency);

		self::setCurrentDomain();

		return 'http://' . self::$current . "/json_object/$id/currency/$currency/ip/" . self::getIpAddress();
	}

	//Проверяем полученные данные
	public static function isJson($string) {
		json_decode($string);

		return (json_last_error() == JSON_ERROR_NONE);
	}


}
