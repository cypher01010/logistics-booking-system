<?php
/**
 * Load the Environment
 */
require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Environment.php');

/**
 * The environment to load
 *
 * @var $environment
 */
$environment = Environment::DEVELOPMENT;

$debug = TRUE;
$env = 'dev';

if($environment === Environment::STAGING || $environment === Environment::PRODUCTION) {
	$debug = TRUE;
	$env = 'production';
}

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', $debug);
defined('YII_ENV') or define('YII_ENV', $env);

require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');
require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'yiisoft' . DIRECTORY_SEPARATOR . 'yii2' . DIRECTORY_SEPARATOR . 'Yii.php');

$config = require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . $environment . '.php');

(new yii\web\Application($config))->run();