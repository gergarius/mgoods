<?php
use yii\helpers\Html;
use app\modules\ratings\models\Ratings;
use yii\widgets\LinkPager;

?>
<div class="h30"></div>
<h2>
	Все отзывы о товаре
</h2>
<div class="clearfix"></div>
<div class="h130"></div>
<?php
$sumMiddle = 0;
$sumGrouped[Ratings::BAD_RAIT] = 0;
$sumGrouped[Ratings::NOT_NICE_RAIT] = 0;
$sumGrouped[Ratings::NORMAL_RAIT] = 0;
$sumGrouped[Ratings::NICE_RAIT] = 0;
$sumGrouped[Ratings::AWESOME_RAIT] = 0;

$ratingCount = count($ratingColumn);

foreach ($ratingColumn as $rait) {
	$sumMiddle += $rait['rating'];
	$sumGrouped[$rait['rating']]++;
}
$sumMiddle = round($sumMiddle / $ratingCount);

$bad_active = 'active';
$not_nice_active = $normal_active = $nice_active = $awesome_active = '';

if ($sumMiddle >= Ratings::NOT_NICE_RAIT) {
	$not_nice_active = 'active';
}
if ($sumMiddle >= Ratings::NORMAL_RAIT) {
	$normal_active = 'active';
}
if ($sumMiddle >= Ratings::NICE_RAIT) {
	$nice_active = 'active';
}
if ($sumMiddle >= Ratings::AWESOME_RAIT) {
	$awesome_active = 'active';
}
?>
<div class="rating-wrap">
	<div class="fl rating-left">
		<div class="obj-border">
			<div class="rating-middle-value">
				Средняя оценка товара покупателями
			</div>
			<div class="clearfix"></div>
			<div class="rating-middle-stars">
				<div name="rating" class="rating-star-wrap">
					<div name="1" class="sprite bad <?= $bad_active ?>" title="ужасно">&nbsp;</div>
					<div name="2" class="sprite not-nice <?= $not_nice_active ?>" title="плохо">&nbsp;</div>
					<div name="3" class="sprite normal <?= $normal_active ?>" title="средне">&nbsp;</div>
					<div name="4" class="sprite nice <?= $nice_active ?>" title="хорошо">&nbsp;</div>
					<div name="5" class="sprite awesome <?= $awesome_active ?>" title="отлично">&nbsp;</div>
				</div>
				<div class="rating-star-value">
					<?= $sumMiddle ?> из 5 звезд
				</div>
			</div>
			<div class="rating-write">
				<?= Html::a('Написать отзыв о товаре', '#ratings-form'); ?>
			</div>
		</div>
	</div>
	<div class="fr rating-right">
		<div class="obj-border">
			<div class="rating-count-value clearfix">
				<div class="rating-count"><?= $sumGrouped[Ratings::AWESOME_RAIT] ?></div>
				<div class="rating-percent">
					<div class="rating-percent-active" style="width: <?= (($sumGrouped[Ratings::AWESOME_RAIT] * 100) / $ratingCount) ?>%"></div>
				</div>
				<div name="rating" class="rating-stars">
					<div name="1" class="sprite bad active" title="ужасно">&nbsp;</div>
					<div name="2" class="sprite not-nice active" title="плохо">&nbsp;</div>
					<div name="3" class="sprite normal active" title="средне">&nbsp;</div>
					<div name="4" class="sprite nice active" title="хорошо">&nbsp;</div>
					<div name="5" class="sprite awesome active" title="отлично">&nbsp;</div>
				</div>
			</div>
			<div class="rating-count-value clearfix">
				<div class="rating-count"><?= $sumGrouped[Ratings::NICE_RAIT] ?></div>
				<div class="rating-percent">
					<div class="rating-percent-active" style="width: <?= (($sumGrouped[Ratings::NICE_RAIT] * 100) / $ratingCount) ?>%"></div>
				</div>
				<div name="rating" class="rating-stars">
					<div name="1" class="sprite bad active" title="ужасно">&nbsp;</div>
					<div name="2" class="sprite not-nice active" title="плохо">&nbsp;</div>
					<div name="3" class="sprite normal active" title="средне">&nbsp;</div>
					<div name="4" class="sprite nice active" title="хорошо">&nbsp;</div>
				</div>
			</div>
			<div class="rating-count-value clearfix">
				<div class="rating-count"><?= $sumGrouped[Ratings::NORMAL_RAIT] ?></div>
				<div class="rating-percent">
					<div class="rating-percent-active" style="width: <?= (($sumGrouped[Ratings::NORMAL_RAIT] * 100) / $ratingCount) ?>%"></div>
				</div>
				<div name="rating" class="rating-stars">
					<div name="1" class="sprite bad active" title="ужасно">&nbsp;</div>
					<div name="2" class="sprite not-nice active" title="плохо">&nbsp;</div>
					<div name="3" class="sprite normal active" title="средне">&nbsp;</div>
				</div>
			</div>
			<div class="rating-count-value clearfix">
				<div class="rating-count"><?= $sumGrouped[Ratings::NOT_NICE_RAIT] ?></div>
				<div class="rating-percent">
					<div class="rating-percent-active" style="width: <?= (($sumGrouped[Ratings::NOT_NICE_RAIT] * 100) / $ratingCount) ?>%"></div>
				</div>
				<div name="rating" class="rating-stars">
					<div name="1" class="sprite bad active" title="ужасно">&nbsp;</div>
					<div name="2" class="sprite not-nice active" title="плохо">&nbsp;</div>
				</div>
			</div>
			<div class="rating-count-value clearfix">
				<div class="rating-count"><?= $sumGrouped[Ratings::BAD_RAIT] ?></div>
				<div class="rating-percent">
					<div class="rating-percent-active" style="width: <?= (($sumGrouped[Ratings::BAD_RAIT] * 100) / $ratingCount) ?>%"></div>
				</div>
				<div name="rating" class="rating-stars">
					<div name="1" class="sprite bad active" title="ужасно">&nbsp;</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="rating-text-wrap">
		<?php foreach ($rating as $rait) { ?>
			<div class="rating-text-id-$rait->id rating-text">
				<div class="rating-text-box">
					<div class="rating-text-star">
						<?php
						$not_nice_active = $normal_active = $nice_active = $awesome_active = '';

						if ($rait->rating >= Ratings::NOT_NICE_RAIT) {
							$not_nice_active = 'active';
						}
						if ($rait->rating >= Ratings::NORMAL_RAIT) {
							$normal_active = 'active';
						}
						if ($rait->rating >= Ratings::NICE_RAIT) {
							$nice_active = 'active';
						}
						if ($rait->rating >= Ratings::AWESOME_RAIT) {
							$awesome_active = 'active';
						} ?>
						<div name="rating" class="rating-star-wrap">
							<div name="1" class="sprite bad <?= $bad_active ?>" title="ужасно">&nbsp;</div>
							<div name="2" class="sprite not-nice <?= $not_nice_active ?>" title="плохо">&nbsp;</div>
							<div name="3" class="sprite normal <?= $normal_active ?>" title="средне">&nbsp;</div>
							<div name="4" class="sprite nice <?= $nice_active ?>" title="хорошо">&nbsp;</div>
							<div name="5" class="sprite awesome <?= $awesome_active ?>" title="отлично">&nbsp;</div>
						</div>
					</div>
					<div class="rating-text-name">
						<?= $rait->name ?>
						<span class="rating-text-created"><span>/</span><?= $rait->created_at ?></span>
					</div>
					<div class="clearfix"></div>
					<div class="rating-text-main">
						<?= $rait->comment ?>
					</div>
				</div>
				<!--
				<div class="rating-text-answer-box">
					<?= Html::a('Ответить', 'http://sdfsdf'); ?>
				</div>
				-->
			</div>
			<div class="clearfix" name="ratings-form"></div>
		<?php } ?>
	</div>
	<div class="pagination-wrap">
		<?php
		echo LinkPager::widget([
			'pagination'     => $pages,
			'prevPageLabel'  => '←   Предыдущая',
			'nextPageLabel'  => 'Следующая   →',
			'maxButtonCount' => 5,
		]);
		?>
	</div>
	<div class="rating-form-wrap">
		<?= $this->render('@app/modules/ratings/views/ratings/_form', [
			'model'     => $model,
			'fieldName' => $fieldName,
		]) ?>
	</div>

</div>
