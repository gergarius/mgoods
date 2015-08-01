<?php
/**
 * Created by PhpStorm.
 * User: ataman
 * Date: 31.07.15
 * Time: 21:59
 */

namespace app\components;
use yii\base\Model;

class ShopForm extends Model{
    public $brands;
    public $isProduct;

    public function rules()
    {
        return [
            // username and password are both required
            [['brands', 'isProduct'], 'safe'],
        ];
    }



    public function attributeLabels()
    {
        return [
          'brands' => 'Бренды',
           'isProduct' => 'Наличие продукта'
        ];
    }

    public function getIsProductList(){
        return [0=>"Все", 1=>"Есть на складе", 2=>"Предзаказ", 4=>"Снят с продаж"];
    }


}