<?php
namespace app\controllers;

class SiteController extends \app\components\BaseController
{
	public function beforeAction($event)
	{
		$this->filterHttps(['*']);

		return parent::beforeAction($event);
	}

	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	public function actionIndex()
	{
		$id = \Yii::$app->session->get('id');
		if(!empty($id)) {
			$this->redirect(\Yii::$app->urlManager->createUrl('user/crud/dashboard'));
		}

		$this->redirect(\Yii::$app->urlManager->createUrl('user/login/index'));
	}
}