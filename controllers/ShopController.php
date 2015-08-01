<?php

namespace app\controllers;

use app\components\ShopData;
use app\components\ShopForm;
use Yii;
use yii\data\Pagination;

class ShopController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $model = new ShopForm();

        $shopName = "rozetka.com.ua";
       // $brand = ["[1]"=>"canon", "[2]"=>"asus"];
        $brand = [];
        $data = ShopData::getDataShop($shopName, $brand);

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

        $model->load(Yii::$app->request->get());

        // pagination
        $pages = new Pagination(['totalCount' => $data->global->goods_count]);

        return $this->render('index', ['data'=>$data, 'model'=>$model, 'pages'=>$pages]);

    }

}
