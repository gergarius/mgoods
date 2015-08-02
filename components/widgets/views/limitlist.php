<?php
use yii\helpers\Html;
?>

Количество товаров на странице <br />
<?=
    Html::a('10','controller/action', [
        'onclick'=>"$('#close').dialog('open');//for jui dialog in my page
            $.ajax({
            type     :'POST',
            cache    : false,
            data : 'limit=10',
            url  : 'shop/limitlist',
            success  : function(response) {
                location.reload();
            }
            });return false;",

    ]);
?>
<?=
Html::a('30','controller/action', [
    'onclick'=>"$('#close').dialog('open');//for jui dialog in my page
    $.ajax({
    type     :'POST',
    cache    : false,
    data : 'limit=30',
    url  : 'shop/limitlist',
    success  : function(response) {
        location.reload();
    }
    });return false;",
]);
?>
<?=
Html::a('50','controller/action', [
    'onclick'=>"$('#close').dialog('open');//for jui dialog in my page
    $.ajax({
    type     :'POST',
    cache    : false,
    data : 'limit=50',
    url  : 'shop/limitlist',
    success  : function(response) {
        location.reload();
    }
    });return false;",
]);
?>