<?php
$params = require(__DIR__ . DIRECTORY_SEPARATOR . 'sub' . DIRECTORY_SEPARATOR . 'params.php');
$params['enforceHTTPS'] = false;
$params['sendSMTPEmail'] = false;
$params['path'] = [
	'signature' => realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'signature' . DIRECTORY_SEPARATOR,
	'document' => realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR,
];

$config = [
	'id' => 'basic',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],
	'modules' => require(__DIR__ . DIRECTORY_SEPARATOR . 'sub' . DIRECTORY_SEPARATOR . 'modules.php'),
	'components' => [
		'request' => [
			'cookieValidationKey' => require(__DIR__ . DIRECTORY_SEPARATOR . 'sub' . DIRECTORY_SEPARATOR . 'cookie.php'),
		],
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'urlManager' => [
			'class' => 'yii\web\UrlManager',
			'enablePrettyUrl' => false,
			'showScriptName' => true,
			//'rules' => require(__DIR__ . DIRECTORY_SEPARATOR . 'sub' . DIRECTORY_SEPARATOR . 'urlManager.php')
		],
		'user' => [
			'identityClass' => 'app\components\UserIdentity',
			'enableAutoLogin' => true,
			'loginUrl' => ['user/login/index'],
		],
		'errorHandler' => [
			'errorAction' => 'errorhandler/default/error',
		],
		'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],
		'response' => [
			'formatters' => [
				'pdf' => [
					'class' => 'yii\pdf\PdfResponseFormatter',
				],
			]
		],
		'db' => [
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=localhost;dbname=rrl_dev_sep_12_2015',
			'username' => 'root',
			'password' => 'admin',
			'charset' => 'utf8',
		],
	],
	'params' => $params,
];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = 'yii\debug\Module';

	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = 'yii\gii\Module';
}

return $config;