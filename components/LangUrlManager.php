<?php
namespace app\components;

use yii\web\UrlManager;
use app\components\Lang;

class LangUrlManager extends UrlManager {

	public function createUrl($params) {

		//shodie($params);
		if (isset($params['lang'])) {
			//Если указан идентификатор языка, то делаем попытку найти язык в БД,
			//иначе работаем с языком по умолчанию
			$lang = in_array($params['lang'], Lang::getAllLang()) ? $params['lang'] : Lang::getDefaultLang();
			unset($params['lang']);
		} else {
			//Если не указан параметр языка, то работаем с текущим языком
			$lang = Lang::getCurrent();
		}
		/*
			//проверяем является ли ссылка внешней
			if (preg_match('/(http|https):\/\//', $params[0])) {
				return parent::createUrl($params);
			}
		*/
		//Получаем сформированный URL(без префикса идентификатора языка)
		$url = parent::createUrl($params);

		//Добавляем к URL префикс - буквенный идентификатор языка
		if ($url == '/') {
			return '/' . $lang;
		} else {
			return '/' . $lang . $url;
		}
	}
}