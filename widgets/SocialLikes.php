<?php
namespace app\widgets;

use \yii\bootstrap\Widget as Widget;

class SocialLikes extends Widget {
	public function init() {
	}

	public function run() {
		return $this->render('@app/views/social/socialLikes');
	}
}