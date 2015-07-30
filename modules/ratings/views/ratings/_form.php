<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use app\modules\ratings\models\Ratings;

/* @var $this yii\web\View */
/* @var $model app\modules\ratings\models\Ratings */
/* @var $form yii\widgets\ActiveForm */
/* @var avalible $fieldName ['object_id' or 'shop_id' or 'good_id'] */

?>

<div class="ratings-form obj-border">
	<h4 class="ratings-form-header">
		Отзыв о товаре
	</h4>
	<?php
	$form = ActiveForm::begin();

	echo $form->field($model, $fieldName)->hiddenInput()->label(false);
	echo $form->field($model, 'rating')->hiddenInput()->label(false);

	$bad_active = $not_nice_active = $normal_active = $nice_active = $awesome_active = '';

	if ($model->rating >= Ratings::NOT_NICE_RAIT) {
		$bad_active = 'active';
	}
	if ($model->rating >= Ratings::NOT_NICE_RAIT) {
		$not_nice_active = 'active';
	}
	if ($model->rating >= Ratings::NORMAL_RAIT) {
		$normal_active = 'active';
	}
	if ($model->rating >= Ratings::NICE_RAIT) {
		$nice_active = 'active';
	}
	if ($model->rating >= Ratings::AWESOME_RAIT) {
		$awesome_active = 'active';
	}
	?>
	<div class="form-group field-ratings-rating">
		<div class="ratings-star-label">Оцените данный товар:</div>
		<div class="ratings-star-select">
			<div name="1" class="sprite bad <?= $bad_active ?>" title="ужасно">&nbsp;</div>
			<div name="2" class="sprite not-nice <?= $not_nice_active ?>" title="плохо">&nbsp;</div>
			<div name="3" class="sprite normal <?= $normal_active ?>" title="средне">&nbsp;</div>
			<div name="4" class="sprite nice <?= $nice_active ?>" title="хорошо">&nbsp;</div>
			<div name="5" class="sprite awesome <?= $awesome_active ?>" title="отлично">&nbsp;</div>
		</div>
		<div class="ratings-star-count"><span>&nbsp;</span> из 5</div>
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

	<?php //echo $form->field($model, 'pluses')->textInput(['maxlength' => true]) ?>

	<?php //echo  $form->field($model, 'minuses')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
		'captchaAction' => '/object/captcha',
		'options' => ['class' => 'form-control'],
		'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-9">{input}</div></div>',
	]) ?>

	<div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'RATING_RECALL_CREATE'), ['class' => 'but-style but-text-style rating-but btn']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>

<script type="application/javascript">
	$(document).ready(function () {
		var ratingClick = <?= $model->rating?$model->rating:0; ?>;
		$('.ratings-form .sprite').on({
			'click': function () {
				//active
				ratingClick = $(this).attr('name');
				$('#ratings-rating').val(ratingClick);
			}
		}).on({
			'mouseover': function () {
				var raitingMouseOver = $(this).attr('name');
				$(".ratings-form .sprite").each(function (i) {
					if ($(this).attr('name') <= raitingMouseOver) {
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
					}
				});
				$('.ratings-star-count').show();
				$('.ratings-star-count span').html(raitingMouseOver);
			}
		});

		$('.ratings-form .ratings-star-select').on({
			'mouseout': function () {
				$(".ratings-form .sprite").each(function (i) {
					if ($(this).attr('name') > ratingClick) {
						$(this).removeClass('active');
					} else {
						$(this).addClass('active');
					}
				});
				if (ratingClick) {
					$('.ratings-star-count span').html(ratingClick);
				} else {
					$('.ratings-star-count').hide();
				}

			}
		});
	});
</script>
