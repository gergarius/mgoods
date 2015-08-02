<?php
use yii\helpers\Html;
use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\Tabs;

use app\widgets\SocialLikes;
use app\components\ObjectData;
use app\components\Currency;
use app\modules\ratings\models\Ratings;

//use yii\bootstrap\ActiveForm;
//use app\widgets\RatingWidget;
//use yii\bootstrap\Carousel;

/* @var $this yii\web\View */

foreach ($data->breadcrumb as $breadcrumb) {
	$this->params['breadcrumbs'][] = [
		'label' => $breadcrumb->name,
		'url'   => "/cat/{$breadcrumb->cat_id}/0"
	];
}

$this->params['breadcrumbs'][] = $data->object->name;

$this->title = $data->object->name;

$AllCurrency = Currency::getAllCurrency();
$AllCurrencyFullName = Currency::getAllCurrencyFullName();
$currentCurrency = Currency::getCurrent();
$currentCurrencyName = $AllCurrency[$currentCurrency];

$this->registerJsFile('/js/jquery.sbscroller.js');
$this->registerJsFile('/js/jquery.mousewheel.min.js');
$this->registerCssFile('/css/jquery.sbscroller.css');
?>
<div class="object-index">
	<h1><?= $data->object->name ?></h1>

	<div class="body-content">
		<div class="fl obj-images">
			<div id="scrollpane1" class="thumbnails scrollpane">
				<div class="scroll-content-item active">
					<span class="helper"></span>
					<?php echo Html::img($data->object->img_link, [
						//'height' => $data->object->img_height,
						'width' => 56,
						'alt'   => $data->object->img_alt,
						'title' => $data->object->img_title,
					]); ?>
					</li>
				</div>
				<?php
				foreach ($data->goods_array as $goods) {
					if (isset($goods->photo) && !empty($goods->photo)) {
						echo '<div class="scroll-content-item"><span class="helper"></span>' . Html::img($goods->photo, [
								'alt'   => $goods->title,
								'title' => $goods->title,
								'width' => 56,
							]) . '</div>';
					}
				} ?>
			</div>

			<div class="scroll-slider-wrapper">
				<div class="slide">
					<span class="helper"></span>
					<?php echo Html::img($data->object->img_link, [
						'alt'   => $data->object->img_alt,
						'title' => $data->object->img_title,
					]); ?>
				</div>
			</div>
		</div>

		<div class="fr obj-desc">
			<div class="obj-border">
				<div class="obj-desc-top">
					<div class="obj-star-raiting">
						<?php

						$sumMiddle = 0;
						$bad_active = 'active';
						$not_nice_active = $normal_active = $nice_active = $awesome_active = '';

						foreach ($ratingColumn as $rait) {
							$sumMiddle += $rait['rating'];
						}
						$sumMiddle = round($sumMiddle / count($ratingColumn));

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
						<div class="rating-widget-stars">
							<div name="rating" class="rating-star-wrap">
								<div name="1" class="sprite bad <?= $bad_active ?>" title="ужасно">&nbsp;</div>
								<div name="2" class="sprite not-nice <?= $not_nice_active ?>" title="плохо">&nbsp;</div>
								<div name="3" class="sprite normal <?= $normal_active ?>" title="средне">&nbsp;</div>
								<div name="4" class="sprite nice <?= $nice_active ?>" title="хорошо">&nbsp;</div>
								<div name="5" class="sprite awesome <?= $awesome_active ?>" title="отлично">&nbsp;</div>
							</div>
							<div class="rating-star-value recall">
								<?= Html::a($sumMiddle . ' отзыва', '#w2-tab2'); ?>
							</div>
						</div>
						<div class="rating-write">
							<?= Html::a('Оценить данный товар', '#w2-tab2#ratings-form'); ?>
						</div>
					</div>
					<div class="obj-social">
						<div class="obj-social-text fl">
							Поделитесь с друзьями:
						</div>
						<div class="obj-social-buttons rf">
							<?= SocialLikes::widget(); ?>
						</div>
					</div>
				</div>

				<div class="obj-desc-bottom">
					<div class="fl obj-price-mid-text">
						Средня цена
					</div>
					<div class="fl obj-curr-select">
						<?php
						$items = [];
						foreach ($AllCurrencyFullName as $currAlias => $currname) {
							$item['label'] = $currname;
							$item['url'] = Yii::$app->urlManager->createUrl(["/object/$id/" . strtolower($currAlias)]);
							$items[] = $item;
						}
						echo ButtonDropdown::widget([
							'label'    => $AllCurrencyFullName[$currentCurrency],
							'options'  => [
								'class' => 'btn-lg btn-default',
							],
							'dropdown' => [
								'items' => $items
							]
						]);
						?>
					</div>
					<div class="obj-curr-price fl">
						<div class="obj-curr-price-mid fl">
							<?= ObjectData::formatPrice($data->object->price_mid); ?>
						</div>
						<div class="obj-curr-price-minmax fl">
							<?= "(" . ObjectData::formatPrice($data->object->price_min) . " - " . ObjectData::formatPrice($data->object->price_max) . ")"; ?>
						</div>
					</div>
					<div class="clearfix"></d                    iv>

						<div class="but-style but-text-style proposals-but">
							<?= Html::a('Смотреть все предложения магазинов (' . $data->object->count_proposals . ')', '#'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="obj-tabs">
			<?= Tabs::widget([
				'items' => [
					[
						'label'   => 'Предложения от магазинов (' . $data->object->count_proposals . ')',
						'content' => $this->render('_proposals', [
							'data' => $data,
						]),
						'active'  => true
					],
					[
						'label'   => 'Описание и характеристики',
						'content' => $this->render('_descriptions', [
							'data' => $data,
						]),
					],
					[
						'label'   => 'Отзывы о товаре (' . count($ratingColumn) . ')',
						'content' => $this->render('_ratings', [
							'rating'       => $rating,
							'pages'        => $pages,
							'model'        => $ratingModel,
							'ratingColumn' => $ratingColumn,
							'fieldName'    => $fieldName,
						]),
					],
				]
			]);

			?>
		</div>

		<!--
Похожие товары
		<div class="container">
			<div class="row clearfix">
				<div class="col-md-12 column">
					<?php /*echo Carousel::widget([
			'items' => [
				[
					'content' => '<img src="http://upload.wikimedia.org/wikipedia/commons/a/a1/Baby_goats_jan_2007_crop.jpg"/>',
					'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
					'options' => ['interval' => '600']
				],
				[
					'content' => '<img src="http://t0.gstatic.com/images?q=tbn:ANd9GcQ-YmEBJbefTMcAHWut4qcZTFuq-ZyTudPjA5HCkSgMvlgf5wM5hQ"/>',
					'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
					'options' => ['interval' => '600']
				],
				[
					'content' => '<img src="http://pixabay.com/static/uploads/photo/2014/08/05/09/58/goat-410279_640.jpg"/>',
					'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
					'options' => ['interval' => '600']
				],
			]
		]);*/ ?>

		</div>
-->


	</div>

	<script type="application/javascript">
		$(document).ready(function () {
			$('#scrollpane1').sbscroller();
			$('.scroll-content-item').on({


					[]rt5f	'click': function () {
					//active
					$('.scroll-content div').removeClass('active');
					var img_src = $('img', this).attr('src');

					$('.scroll-slider-wrapper img').fadeOut("fast", function () {
						$('.scroll-slider-wrapper img').attr('src', img_src);
						$('.scroll-slider-wrapper img').fadeIn("fast");
					});
					$(this).addClass('active');
				}
			});
		});
	</script>
<?php

ssh://git@star-vm.dt00.net:22/gitosis-admin.git
mkdir mgoods.git && cd mgoods.git/