<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\BadRequestHttpException;

use app\components\Currency;
use app\components\ObjectData;

class ObjectController extends Controller {
	public function behaviors() {
		return [];
	}

	public function actions() {
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			/*'captcha' => [
				'class' => 'yii\captcha\CaptchaAction', 'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],*/
		];
	}

	public function actionIndex($id, $currency = 'usd') {
		Currency::setCurrent($currency);

		$data = ObjectData::getData($id);

		if (!$data) {
			throw new BadRequestHttpException(Yii::t('app', 'Specified record is not found'), 404);
		}

		$this->view->params['global'] = $data->global;

		Yii::$app->view->registerMetaTag([
			'name'    => 'description',
			'content' => $data->object->metadescription
		]);
		Yii::$app->view->registerMetaTag([
			'name'    => 'keywords',
			'content' => $data->object->metakeywords
		]);


		return $this->render('index', [
			'data' => $data,
			'id'   => $id,
		]);
	}

	public function actionObject_ratings() {
		$model = new ObjectRatings();

		if ($model->load(Yii::$app->request->post())) {
			if ($model->validate()) {
				// form inputs are valid, do something here
				return;
			}
		}

		return $this->render('object_ratings', [
			'model' => $model,
		]);
	}


	/*public function actionContact() {
		$model = new ContactForm();
		if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
			Yii::$app->session->setFlash('contactFormSubmitted');

			return $this->refresh();
		} else {
			return $this->render('contact', [
				'model' => $model,
			]);
		}
	}*/

}
