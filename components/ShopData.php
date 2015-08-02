<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 27.07.15
 * Time: 14:22
 */

namespace app\components;
use Yii;

class ShopData extends PageData {
    //Получения всех доменов данных
    public static function getDataDomain() {
        return Yii::$app->params['DataDomain'];
    }

    //Получения ссылки данных
    public static function getDataUrl($shop_name, array $brand) {

        $currency = Currency::getCurrent();
        $currency = strtolower($currency);

        self::setCurrentDomain();

        //$url = "http://dev.goods.marketgid.com/json_shop/pingvinpc.ru/30/?brand=canon";
        $url = 'http://' . self::$dataDomain . "/json_shop/$shop_name/0/";
        if(count($brand) > 0){
            $arr = [];
            foreach($brand as $v){
                $arr['brand[]'] = $v;
            }
            if(Yii::$app->request->cookies->getValue('limit')){
                $arr['limit'] = Yii::$app->request->cookies->getValue('limit');
            }

            $arr['page'] = Yii::$app->request->get('page', 1);

            $query = http_build_query($arr);
            $url .= "?".$query;
        }

        echo $url;

        return $url;
    }

    // ПОлучение данных
    public static function getDataShop($shop_name, array $brand){
        return parent::getJson(self::getDataUrl($shop_name, $brand));
    }

}