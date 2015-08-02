<?php
namespace app\controllers;

use Yii;

class SiteController extends \yii\web\Controller {

	public function actions() {
		return [
			'error'   => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'transparent'=>true,
				'minLength'=>3,
				'maxLength'=>3,
				'fixedVerifyCode' => 'testme',
				//'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
				//'TestLimit '      => 100,
			],

			/*'captcha' => [
				'class' => 'mdm\captcha\CaptchaAction',
				'level' => 1, // avaliable level are 1,2,3 :D
			],*/
		];
	}

}
