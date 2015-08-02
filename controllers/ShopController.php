<?php

namespace app\controllers;

use app\components\ShopData;
use Yii;


class ShopController extends \yii\web\Controller {

	public function actionIndex($id) {

		// $brand = ["[1]"=>"canon", "[2]"=>"asus"];
		$brand = [];
		$data = ShopData::getDataShop($id, $brand);

		if (!$data) {
			throw new BadRequestHttpException(Yii::t('app', 'Specified record is not found'), 404);
		}

		Yii::$app->view->registerMetaTag([
			'name'    => 'description',
			'content' => $data->shop->metadescription
		]);
		Yii::$app->view->registerMetaTag([
			'name'    => 'keywords',
			'content' => $data->shop->metakeywords
		]);

		return $this->render('index', ['data' => $data]);

	}

}
