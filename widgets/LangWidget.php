<?php
namespace app\widgets;

use app\components\Lang;
use \yii\bootstrap\Widget as Widget;

class LangWidget extends Widget {
	public function init() {
	}

	public function run() {
		return $this->render('@app/views/lang/view', [
			'current' => Lang::getCurrent(),
			'langs'   => Lang::getAllLang(),
		]);
	}
}