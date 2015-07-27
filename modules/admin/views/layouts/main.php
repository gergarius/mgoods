<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\modules\admin\assets\AdminAsset;

use app\components\widgets\Alert;

use app\widgets\LangWidget;
use app\components\CatalogData;


/* @var $this \yii\web\View */
/* @var $content string */

AdminAsset::register($this);
\yii\web\JqueryAsset::register($this);

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
		?>
		<div class="admin-naw-wrap pull-right">
			<?php echo Nav::widget([
				'options'         => ['class' => 'navbar-nav navbar-right'],
				'activateParents' => true,
				'items'           => array_filter([
					['label' => Yii::t('app', 'NAV_HOME'), 'url' => ['/main/default/index']],
					['label' => Yii::t('app', 'NAW_CONTACT'), 'url' => ['/main/contact/index']],
					Yii::$app->user->isGuest ? ['label' => Yii::t('app', 'NAV_SIGNUP'), 'url' => ['/user/default/signup']] : false,
					Yii::$app->user->isGuest ? ['label' => Yii::t('app', 'NAV_LOGIN'), 'url' => ['/user/default/login']] : false,
					!Yii::$app->user->isGuest ? [
						'label' => Yii::t('app', 'NAV_ADMIN'),
						'items' => [
							['label' => Yii::t('app', 'NAV_ADMIN'), 'url' => ['/admin/default/index']],
							['label' => Yii::t('app', 'ADMIN_USERS'), 'url' => ['/admin/users/index']],
						]
					] : false,
					!Yii::$app->user->isGuest ? [
						'label' => Yii::t('app', 'NAV_PROFILE'),
						'items' => [
							['label' => Yii::t('app', 'NAV_PROFILE'), 'url' => ['/user/profile/index']],
							[
								'label'       => Yii::t('app', 'NAV_LOGOUT'),
								'url'         => ['/user/default/logout'],
								'linkOptions' => ['data-method' => 'post']
							]
						]
					] : false,
				]),
			]);
			?>
		</div>
		<?php NavBar::end(); ?>
	</div>
	<div class="container">
		<?= Breadcrumbs::widget([
			'itemTemplate'       => "<li><span>/</span>{link}</li>\n",
			'activeItemTemplate' => "<li class=\"active\"><span>/</span>{link}</li>\n",
			'homeLink'           => [
				'label'    => " ",
				'url'      => Yii::$app->homeUrl,
				'template' => "<li><span class='home-link'>{link}</span></li>\n",
			],
			'links'              => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		]);
		?>
		<?= $content ?>
		<?= Alert::widget() ?>
	</div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
