<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\Menu;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

use app\components\widgets\Alert;

use app\widgets\LangWidget;
use app\components\CatalogData;


/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
\yii\web\JqueryAsset::register($this);
$CatalogData = CatalogData::getData();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div class="wrap">
	<div class="top-naw navbar-fixed-top clearfix">
		<?php
		NavBar::begin([
			'brandLabel' => "<img class='img-responsive' height='50' width='201' src='" . Yii::$app->request->baseUrl . "/img/logo.png' alt='Logo'>",
			'brandUrl'   => Yii::$app->homeUrl,
		]);
		/*echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-right'],
			'items' => [
				['label' => 'Home', 'url' => ['/site/index']],
				['label' => 'About', 'url' => ['/site/about']],
				['label' => 'Contact', 'url' => ['/site/contact']],
			],
		]);
		*/
		?>
		<div class="lang-widget-wrap pull-right">
			<?= LangWidget::widget(); ?>
		</div>
		<div class="goods-widget-wrap pull-right">
			Товаров:
			<?php // echo Html::a($this->params['global']->goods_count, [$this->params['global']->goods_count_link]); ?>
		</div>
		<div class="shops-widget-wrap pull-right">
			Магазинов:
			<?php // echo Html::a($this->params['global']->shops_count, [$this->params['global']->shops_count_link]); ?>
		</div>

		<?php NavBar::end(); ?>
	</div>
	<div class="middle-naw clearfix">
		<div class="container">
			<div class="but-style but-text-style catalog-but">
				<div class="icon-menu"></div>
				<div class="text-menu">Каталог Товаров</div>
				<?php
				$items = [];
				$count = 0;
				foreach ($CatalogData->category as $ItemId0 => $catSubItem0) {
					$items[$ItemId0] = [
						'label' => $catSubItem0->name,
						'url'   => ["/cat/{$ItemId0}/0/"],
					];

					if (isset($catSubItem0->cell_items)) {
						foreach ($catSubItem0->cell_items as $ItemId1 => $catSubItem1) {
							$items[$ItemId0]['options'] = ['class' => "dropdown-submenu"];
							$items[$ItemId0]['items'][$ItemId1] = [
								'label' => $catSubItem1->name,
								'url'   => ["/cat/{$ItemId1}/0/"],
							];
							if (isset($catSubItem1->cell_items)) {
								foreach ($catSubItem1->cell_items as $ItemId2 => $catSubItem2) {
									$items[$ItemId0]['items'][$ItemId1]['options'] = ['class' => "dropdown-submenu"];
									$items[$ItemId0]['items'][$ItemId1]['items'][$ItemId2] = [
										'label' => $catSubItem2->name,
										'url'   => ["/cat/{$ItemId2}/0/"],
									];
									if (isset($catSubItem2->cell_items)) {
										foreach ($catSubItem2->cell_items as $ItemId3 => $catSubItem3) {
											$items[$ItemId0]['items'][$ItemId1]['items'][$ItemId2]['options'] = ['class' => "dropdown-submenu"];
											$items[$ItemId0]['items'][$ItemId1]['items'][$ItemId2]['items'][$ItemId3] = [
												'label' => $catSubItem3->name,
												'url'   => ["/cat/{$ItemId3}/0/"],
											];
											if (isset($catSubItem3->cell_items)) {
												foreach ($catSubItem3->cell_items as $ItemId4 => $catSubItem4) {
													$items[$ItemId0]['items'][$ItemId1]['items'][$ItemId2]['items'][$ItemId3]['options'] = ['class' => "dropdown-submenu"];
													$items[$ItemId0]['items'][$ItemId1]['items'][$ItemId2]['items'][$ItemId3]['items'][$ItemId4] = [
														'label' => $catSubItem4->name,
														'url'   => ["/cat/{$ItemId4}/0/"],
													];
													//echo '№' . $count . " " . $catSubItem4->name . "-" . $ItemId4.'<br>';$count++;
													if (isset($catSubItem4->cell_items)) {
														foreach ($catSubItem4->cell_items as $ItemId5 => $catSubItem5) {
															$items[$ItemId0]['items'][$ItemId1]['items'][$ItemId2]['items'][$ItemId3]['items'][$ItemId4]['options'] = ['class' => "dropdown-submenu"];
															$items[$ItemId0]['items'][$ItemId1]['items'][$ItemId2]['items'][$ItemId3]['items'][$ItemId4]['items'][$ItemId5] = [
																'label' => $catSubItem5->name,
																'url'   => ["/cat/{$ItemId5}/0/"],
															];
															//echo '№' . $count . ")" . $catSubItem5->name . "-" . $ItemId5.'<br>';$count++;
															if (isset($catSubItem5->cell_items)) {
																foreach ($catSubItem5->cell_items as $ItemId6 => $catSubItem6) {
																	$items[$ItemId0]['items'][$ItemId1]['items'][$ItemId2]['items'][$ItemId3]['items'][$ItemId4]['items'][$ItemId5]['options'] = ['class' => "dropdown-submenu"];
																	$items[$ItemId0]['items'][$ItemId1]['items'][$ItemId2]['items'][$ItemId3]['items'][$ItemId4]['items'][$ItemId6] = [
																		'label' => $catSubItem6->name,
																		'url'   => ["/cat/{$ItemId6}/0/"],
																	];
																}
																//echo '№' . $count . " " . $catSubItem6->name . "-" . $ItemId6.'<br>';$count++;
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
				//die();
				?>
				<?= Menu::widget([
					'items'           => $items,
					'submenuTemplate' => "\n<ul class='dropdown-menu'>\n{items}\n</ul>\n",
					'options'         => ['class' => 'pull-left dropdown-menu', 'role' => 'menu', 'aria-labelledby' => "dLabel"]
				]);
				?>
			</div>
			<div class="search-field">

			</div>
			<div class="but-style but-text-style search-but">
				Поиск
			</div>
		</div>
	</div>
	<div class="container">
		<?= Breadcrumbs::widget([
			'itemTemplate'       => "<li><span>/</span>{link}</li>\n",
			'activeItemTemplate' => "<li class=\"active\"><span>/</span>{link}</li>\n",
			'homeLink'     => [
			'label'    => " ",
			'url'      => Yii::$app->homeUrl,
			'template' => "<li><span class='home-link'>{link}</span></li>\n",
		],
			'links'        => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		]);
		?>
		<?= $content ?>
		<?= Alert::widget() ?>
	</div>
</div>

<footer class="footer">
	<div class="container">
		<div class="top-menu">
			<?= Menu::widget([
				'items'        => [
					['label' => 'для магазинов', 'url' => 'http://usr.marketgid.com/feedback/forshops/',],
					['label' => 'пишите нам', 'url' => 'http://usr.marketgid.com/feedback/contact/',],
					['label' => 'реклама на сайте', 'url' => 'http://usr.marketgid.com/demo/clicks/',],
					['label' => 'пользовательское соглашение ', 'url' => 'http://usr.marketgid.com/demo/license/',],
				],
				'linkTemplate' => '<a href="{url}" target="_blank">{label}</a>',
				'options'      => ['class' => 'pull-left menu_footer']
			]);
			?>
			<div class="pull-right social-buttons">
				<ul>
					<li>
						<?= Html::a('&nbsp;', 'http://vk.com', ['class' => 'vk', 'target' => '_blank']); ?>
					</li>
					<li>
						<?= Html::a('&nbsp;', 'http://facebook.com', ['class' => 'facebook', 'target' => '_blank']); ?>
					</li>
					<li>
						<?= Html::a('&nbsp;', 'http://twitter.com', ['class' => 'twitter', 'target' => '_blank']); ?>
					</li>
					<li>
						<?= Html::a('&nbsp;', 'http://google.com', ['class' => 'google', 'target' => '_blank']); ?>
					</li>
				</ul>
			</div>
		</div>
		<div class="bottom-menu">
			<?php
			$items = [];
			foreach ($CatalogData->category as $catid => $catItem) {
				$items[] = [
					'label' => $catItem->name,
					'url'   => ["/cat/{$catid}/0/"],
				];
			}
			?>
			<?= Menu::widget([
				'items'   => $items,
				'options' => ['class' => 'pull-left menu_footer']
			]);
			?>
			<div class="clearfix"></div>
		</div>
		<div class="footer-bottom">
			<p class="pull-left">&copy; 2008–2015 MarketGid .<?= date('Y') ?></p>

			<p class="pull-right">
				<!--bigmir)net TOP 100 Part 2-->
				<a href="http://top.bigmir.net/stat/16788227/" target="_blank" onClick='img=new Image();img.src="http://www.bigmir.net/?cl=16788227";'>
					<img src="http://i.bigmir.net/cnt/b01.png" width="88" height="31" border="0" alt="bigmir)net TOP 100" title="bigmir)net TOP 100">
				</a>
				<!--bigmir)net TOP 100 Part 2-->
				<script type="text/javascript">
					<!--//-->
					//<![CDATA[//><!--
					//var pp_gemius_identifier = new String('0nIw268yC22SCj93AIK4h5a0rsvFhoOC1PcEjKhA0e..x7');
					//--><!
					//]]>
				</script>
				<script type="text/javascript" src="http://mg.dt00.net/public/informers/xgemius.js"></script>


				<!--LiveInternet counter-->
				<script type="text/javascript"><!--
					document.write("<a href='http://www.liveinternet.ru/click;MG' " +
					"target=_blank><img src='//counter.yadro.ru/hit;MG?t16.6;r" +
					escape(document.referrer) + ((typeof(screen) == "undefined") ? "" :
					";s" + screen.width + "*" + screen.height + "*" + (screen.colorDepth ?
						screen.colorDepth : screen.pixelDepth)) + ";u" + escape(document.URL) +
					";" + Math.random() +
					"' alt='' title='LiveInternet: показано число просмотров за 24" +
					" часа, посетителей за 24 часа и за сегодня' " +
					"border='0' width='88' height='31'></a>")
					//--></script>
				<!--/LiveInternet-->

				<!--begin of Rambler's Top100 code -->
				<a href="http://top100.rambler.ru/top100/">
					<img src="http://counter.rambler.ru/top100.cnt?1204035" alt="" width=1 height=1 border=0>
				</a>
				<!--end of Top100 code-->
				<!--begin of Top100 logo-->
				<a href="http://top100.rambler.ru/top100/">
					<img src="http://top100-images.rambler.ru/top100/w9.gif" alt="Rambler's Top100" width=88 height=31 border=0>
				</a>
				<!--end of Top100 logo -->

				<!--Rating.ru COUNTEr-->
				<script language="JavaScript" type="text/javascript"><!--
					d = document;
					var a = '';
					a += ';r=' + escape(d.referrer)
					js = 10//--></script>
				<script language="JavaScript1.1" type="text/javascript"><!--
					a += ';j=' + navigator.javaEnabled()
					js = 11//--></script>
				<script language="JavaScript1.2" type="text/javascript"><!--
					s = screen;
					a += ';s=' + s.width + '*' + s.height
					a += ';d=' + (s.colorDepth ? s.colorDepth : s.pixelDepth)
					js = 12//--></script>
				<script language="JavaScript1.3" type="text/javascript"><!--
					js = 13//--></script>
				<script language="JavaScript" type="text/javascript"><!--
					d.write('<a href="http://top.mail.ru/jump?from=1301840"' +
					' target=_top><img src="http://dd.cd.b3.a1.top.list.ru/counter' +
					'?id=1301840;t=234;js=' + js + a + ';rand=' + Math.random() +
					'" alt="Рейтинг.ru"' + ' border=0 height=31 width=88/></a>')
					if (11 < js)d.write('<' + '!-- ')//--></script>
			<noscript><a
					target=_top href="http://top.mail.ru/jump?from=1301840"><img
						src="http://dd.cd.b3.a1.top.list.ru/counter?js=na;id=1301840;t=234"
						border=0 height=31 width=88
						alt="Рейтинг.ru"/></a></noscript>
			<script language="JavaScript" type="text/javascript"><!--
				if (11 < js)d.write('--' + '>')//--></script>
			<!--/COUNTER-->
			</p>
		</div>
	</div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
