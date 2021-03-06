<?php

use yii\helpers\ArrayHelper;

$params = ArrayHelper::merge(require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php'));

$config = [
	'id'         => 'base',
	'name'       => 'MarketGid Goods',
	'basePath'   => dirname(__DIR__),
	'bootstrap'  => ['log', 'gii'],
	//'defaultRoute'   => 'object/index',
	//'sourceLanguage' => 'en',
	'language'   => 'ru',
	'language'   => 'ru-RU',
	'modules'    => [
		'admin'   => [
			'class' => 'app\modules\admin\Module',
		],
		'ratings' => [
			'class' => 'app\modules\rating\Module',
		],
		'user'    => [
			'class' => 'app\modules\user\Module',
		],
		'gii'     => [
			'class' => 'yii\gii\Module',
		],
	],
	'components' => [
		'request'        => [// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
		                     'cookieValidationKey' => 'g00WSAe0q8CykkNE51qrtCqAnPTDi0un',
		                     'class'               => 'app\components\LangRequest'
		],
		'authManager'    => [
			'class'          => 'yii\rbac\PhpManager',
			'defaultRoles'   => ['user', 'admin'],
			'itemFile'       => '@app/rbac/data/items.php',
			'assignmentFile' => '@app/rbac/data/assignments.php',
			'ruleFile'       => '@app/rbac/data/rules.php'
		],
		'user'           => [
			'identityClass'   => 'app\modules\user\models\User',
			'enableAutoLogin' => true,
		],
		'assetManager'   => [
			'bundles' => [
				'yii\web\JqueryAsset' => [
					'sourcePath' => null,
					'basePath'   => '@webroot',
					'baseUrl'    => '@web',
					'js'         => [
						'js/jquery.min.js',
						'js/jquery-ui.min.js',
					]
				],
			],
		],
		'i18n'           => [
			'translations' => [
				'*' => [
					'class'            => 'yii\i18n\PhpMessageSource',
					'basePath'         => 'messages',
					//'sourceLanguage'   => 'en',
					'forceTranslation' => true,
					'fileMap'          => [
						'app' => 'app.php',
					],
				],
			],
		],
		'languagepicker' => [
			'class'      => 'lajax\languagepicker\Component',
			'languages'  => function () {                        // List of available languages (icons and text)
				return app\components\Lang::getAllLang();
			},
			// List of available languages (icons only)
			'cookieName' => 'language',
			// Name of the cookie.
			'expireDays' => 64,
			// The expiration time of the cookie is 64 days.
			/*'callback'   => function () {
				if (!\Yii::$app->user->isGuest) {
					$user = \Yii::$app->user->identity;
					$user->language = \Yii::$app->language;
					$user->save();
				}
			}*/
		],
		'urlManager'     => [
			'enablePrettyUrl' => true,
			'showScriptName'  => false,
			'class'           => 'app\components\LangUrlManager',
			'rules'           => [
				'<controller:\w+>'                                                               => '<controller>/index',
				'<controller:\w+>/<id>'                                                          => '<controller>/index',
				'<controller:\w+>/<id>/<currency:\w+>'                                           => '<controller>/index',
				'<controller:\w+>/<action:\w+>/'                                                 => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>/<id>'                                             => '<controller>/<action>',
				'<_a:(login|logout|signup|confirm-email|request-password-reset|reset-password)>' => 'user/default/<_a>',
				'<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>'                                             => '<_m>/<_c>/view',
				'<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>'                                => '<_m>/<_c>/<_a>',
				'<_m:[\w\-]+>'                                                                   => '<_m>/default/index',
				'<_m:[\w\-]+>/<_c:[\w\-]+>'                                                      => '<_m>/<_c>/index',
			]
		],
		'db'             => ArrayHelper::merge(require(__DIR__ . '/db.php'), require(__DIR__ . '/db.php')),
		'errorHandler'   => [
			'errorAction' => 'object/error'
		],
		'mailer'         => [
			'class' => 'yii\swiftmailer\Mailer',
		],
		/*'cache'          => [
			'class' => 'yii\caching\DummyCache',
		],*/
		'log'            => [
			'class' => 'yii\log\Dispatcher',
		],
	],
	'params'     => $params,
];

//require_once("../components/LangRequest.php");

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = 'yii\debug\Module';

	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
