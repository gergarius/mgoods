<?php
/* @var $this yii\web\View */
use app\widgets\SocialLikes;

use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<h3>Список товаров</h3>
<div  style="float: left;">
    // Форма слева выбора бренда и наличия товара
    <?php $form = ActiveForm::begin([
        'id' => 'shop-form',
        'method' => "GET"

    ]); ?>

    <?= $form->field($model, 'brands')->checkboxList($data->shop->brands_list);  ?>
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
<div  style="float: left;">
    <?php
    $listTovars = $data->goods_array;

    foreach($listTovars as $k=>$v){

        echo "id tovars - ".$k." ".$v->brand_name." - ".Html::img($v->img_link)." Цена : ".$v->price."<br />";
        // id tovars позволяет переходить по ссылке http://dev.goods.marketgid.com/goods/4985061/
    }

    ?>
</div>
<div style="clear: both;"></div>


<div class="object-index">
    <h1>Магазин <span style="font-family: OpenSansBold"><?= $data->shop->html_title; ?></span></h1>
    <div class="headershop">
        <div class="img">
            dsd
        </div>
        <div class="info">
            <a href="#"><?= $data->shop->html_title; ?></a>
            <br />
            <img src="/img/stars.gif" alt=""/> <img src="/img/dialog.gif" alt=""/> <a href="#">3 отзыва</a>
            <div class="obj-social">
                <br />
                <div class="obj-social-buttons rf">
                    <?= SocialLikes::widget(); ?>
                </div>
            </div>
        </div>
        <div class="buttons">
            <a class="send" href="#">Написать менеджеру</a>
            <a class="call" href="#">Позвонить менеджеру</a>
        </div>
        <div style="clear: both;"></div>
    </div>
    <div class="obj-tabs">
        <?php
        echo Tabs::widget([
            'items' => [
                [
                    'label'   => 'Предложения от магазинов (33)',
                   'content' => $this->render('_proposals', [
                        'data' => $data,
                    ]),
                    'active'  => true
                ],
                [
                    'label'   => 'Описание и характеристики',
                    'content' => 'tab 2',
                ],
                [
                    'label'   => 'Отзывы о товаре (3)',
                    'content' => 'tab 3',
                ],
            ]
        ]);
        ?>
    </div>
</div>



