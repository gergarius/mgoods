<?php
/* @var $this yii\web\View */

use app\widgets\SocialLikes;
use yii\bootstrap\Tabs;


?>

<?php echo $this->render("index_test", ['model'=>$model, 'data'=>$data, 'pages'=>$pages]); ?>


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



