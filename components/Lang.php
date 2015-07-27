<?php
namespace app\components;

use Yii;
use \yii\web\Cookie;

class Lang extends \yii\base\Object {

	///Переменная, для хранения текущего объекта языка
	public static $current = null;

	//Получение текущего объекта языка
	public static function getCurrent() {
		if (self::$current === null) {
			self::$current = self::getDefaultLang();
		}

		return self::$current;
	}

	//Установка текущего объекта языка и локаль пользователя
	public static function setCurrent($language = null) {

		$supportedLanguages = self::getAllLang();
		if ($language != null) {
			$language = in_array($language, $supportedLanguages) ? $language : null;
		}

		//Проверим есть ли куки с предпочитаемым языком
		if ($language == null) {
			$language = isset(Yii::$app->request->cookies['language']) ? (string)Yii::$app->request->cookies['language'] : null;
		}

		//Проверяем предпотитаемый язык браузера
		if ($language == null) {
			$language = Yii::$app->request->getPreferredLanguage($supportedLanguages);
		}
		//Если автоматически язык не быбран, то берем поумолчанию
		self::$current = ($language != null) ? $language : self::getDefaultLang();

		$languageCookie = new Cookie([
			'name'   => 'language',
			'value'  => self::$current,
			'expire' => time() + 60 * 60 * 24 * 30, // 30 days
		]);
		Yii::$app->response->cookies->add($languageCookie);

		Yii::$app->language = self::$current;
	}

	//Получения языка по умолчанию
	public static function getDefaultLang() {
		return Yii::$app->params['defaultLang'];
	}

	//Получения всех языков
	public static function getAllLang() {
		return [
			'en',
			'ru',
			'de',
			'pl',
			'ro'
		];
	}
}
