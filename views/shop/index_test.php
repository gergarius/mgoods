<?php

use app\components\widgets\LimitList;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;

?>
<h3>Список товаров</h3>
<div  style="float: left; width: 300px;">

    <?php

    echo "<br />";
    echo LimitList::widget();
    ?>


    <?php $form = ActiveForm::begin([
        'id' => 'shop-form',
        'method' => "GET",
        'action' => ['shop/index'],

    ]); ?>
    <div style="height: 200px; overflow: scroll">

        <?= $form->field($model, 'brands')->checkboxList($model->getBrandsList($data->shop->brands_list));  ?>
    </div>

    <?= $form->field($model, 'isProduct')->dropDownList($model->IsProductList)?>

    <?php ActiveForm::end();?>
    <script>
        $(function(){
            $("#shopform-brands div.checkbox label input[type=checkbox]").change(function(){
                $("#shop-form").submit();
            });
            $("#shopform-isproduct").change(function(){
                $("#shop-form").submit();
            });

        });
    </script>
</div>
<div  style="float: left; width: 600px;">
    <?php

    $listTovars = (isset($data->goods_array))?$data->goods_array:[];
    // количество товара для пагинатора
    $countsProduct = $data->shop->query_goods_count;
    echo "Кол-во товаров : ".$countsProduct."<br /><br />";

    foreach($listTovars as $k=>$v){

        echo "id tovars - ".$k." ".$v->brand_name." - ".Html::img($v->img_link)." Цена : ".$v->price."<br />";
        // id tovars позволяет переходить по ссылке http://dev.goods.marketgid.com/goods/4985061/
    }
    echo "<br /><br />";
    // display pagination
    echo LinkPager::widget([
        'pagination' => $pages,
    ]);
    ?>
</div>
<div style="clear: both;"></div>