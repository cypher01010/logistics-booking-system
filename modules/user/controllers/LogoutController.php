<?php
namespace app\modules\user\controllers;

class LogoutController extends \app\components\BaseController
{
	public function actionIndex()
	{
		\Yii::$app->user->logout();
		\Yii::$app->session->destroy();
		$this->redirect(\Yii::$app->urlManager->createUrl('site/index'));
	}
}