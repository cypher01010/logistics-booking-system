<?php
$params = require(__DIR__ . DIRECTORY_SEPARATOR . 'sub' . DIRECTORY_SEPARATOR . 'params.php');
$params['enforceHTTPS'] = false;
$params['sendSMTPEmail'] = true;
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
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => require(__DIR__ . DIRECTORY_SEPARATOR . 'sub' . DIRECTORY_SEPARATOR . 'urlManager.php')
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
			'dsn' => 'mysql:host=localhost;dbname=rrl_staging',
			'username' => 'quizzy',
			'password' => 'pCAxcsp',
			'charset' => 'utf8',
		],
	],
	'params' => $params,
];

return $config;