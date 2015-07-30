<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\ratings\models\Ratings */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Ratings',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ratings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ratings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
