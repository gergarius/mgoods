<?php
namespace app\components;

use Yii;
use app\components\Lang;
use app\components\Data;
use app\components\Currency;

class ObjectData extends PageData {

	//Получения всех доменов данных
	public static function getDataDomain() {
		return Yii::$app->params['DataDomain'];
	}

	//Получения ссылки данных
	public static function getDataUrl($id) {

		$currency = Currency::getCurrent();
		$currency = strtolower($currency);

		self::setCurrentDomain();

		return 'http://' . self::$current . "/json_object/$id/currency/$currency/ip/" . self::getIpAddress();
	}

}
