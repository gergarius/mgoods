<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\BadRequestHttpException;
use yii\data\Pagination;

use app\components\Currency;
use app\components\ObjectData;
use app\modules\ratings\models\Ratings;

class ObjectController extends Controller {
	public function behaviors() {
		return [];
	}

	public function actions() {
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
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

		$ratingModel = new Ratings;

		if ($ratingModel->load(Yii::$app->request->post())) {
			if ($ratingModel->validate()) {
				shodie($ratingModel);
				$ratingModel->save();
			}
		}

		shodie($ratingModel);

		$ratingModel->object_id = $id;
		$fieldName = 'object_id';

		$query = Ratings::getActiveRating('object_id', $id);
		$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 10]);
		$rating = $query->offset($pages->offset)->limit($pages->limit)->all();

		return $this->render('index', [
			'data'        => $data,
			'rating'      => $rating,
			'pages'       => $pages,
			'id'          => $id,
			'ratingModel' => $ratingModel,
			'fieldName' => $fieldName,
		]);
	}

}
