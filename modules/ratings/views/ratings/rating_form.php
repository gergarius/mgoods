<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\ratings\models\Ratings */
/* @var $form ActiveForm */
?>
<div class="rating_form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'created_at') ?>
        <?= $form->field($model, 'updated_at') ?>
        <?= $form->field($model, 'updated_by_user_id') ?>
        <?= $form->field($model, 'object_id') ?>
        <?= $form->field($model, 'shop_id') ?>
        <?= $form->field($model, 'good_id') ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'comment') ?>
        <?= $form->field($model, 'rating') ?>
        <?= $form->field($model, 'status') ?>
        <?= $form->field($model, 'pluses') ?>
        <?= $form->field($model, 'minuses') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- rating_form -->
