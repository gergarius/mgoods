<?php
namespace app\components;

use Yii;
use app\components\Lang;
use app\components\Data;

class CatalogData extends Data {

	//Переменная, для хранения текущего домена данных
	public static $catalog = null;

	public static function setData() {
		return parent::getJson(self::getDataUrl());
	}

	public static function getData() {
		if (self::$catalog === null) {
			self::$catalog = self::setData();
		}

		return self::$catalog;
	}

	//Получения домена данных по умолчанию
	public static function getDataDomain() {
		return Yii::$app->params['CatalogDataDomain'];
	}

	//Получения ссылки данных

	public static function getDataUrl() {
		return 'http://' . self::getDataDomain() . "/json_category_tree/2/lang/" . Lang::$current . "/";
	}

	//Проверяем полученные данные
	public static function isJson($string) {
		json_decode($string);

		return (json_last_error() == JSON_ERROR_NONE);
	}


}
