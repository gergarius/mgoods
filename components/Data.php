<?php
namespace app\components;

class Data {

	//Получение массива данных
	public static function getJson($url) {
		$data = file_get_contents($url);
		if (self::isJson($data)) {
			return json_decode($data);
		}

		return false;
	}

	//Проверяем полученные данные
	public static function isJson($string) {
		json_decode($string);

		return (json_last_error() == JSON_ERROR_NONE);
	}

}
