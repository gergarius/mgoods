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

        $model->load(Yii::$app->request->get());
        $shopName = "rozetka.com.ua";


        $data = ShopData::getDataShop($shopName, (is_array($model->brands))?$model->brands:[]);

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



        // pagination
        $pages = new Pagination(['totalCount' => $data->shop->query_goods_count, 'defaultPageSize'=>Yii::$app->request->cookies->getValue('limit', 30)]);

        return $this->render('index', ['data'=>$data, 'model'=>$model, 'pages'=>$pages]);

    }


    /**
     * Количество записей на странице. Храним в cookie
     */

    public function actionLimitlist(){
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost){

            echo "value ^ ".Yii::$app->request->post('limit');

            Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name' => 'limit',
                'value' => Yii::$app->request->post('limit')
            ]));
        }
    }

}
