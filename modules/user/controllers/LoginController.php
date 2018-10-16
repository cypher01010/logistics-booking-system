<?php
namespace app\modules\user\controllers;

class LoginController extends \app\components\BaseController
{
	public function actionIndex()
	{
		$id = \Yii::$app->session->get('id');
		if(!empty($id)) {
			$this->redirect(\Yii::$app->urlManager->createUrl('user/crud/dashboard'));
		}
		$this->setLayout('/rrl');

		$customerLoginForm = new \app\modules\user\forms\CustomerLoginForm;
		$driverLoginForm = new \app\modules\user\forms\DriverLoginForm;
		$adminLoginForm = new \app\modules\user\forms\AdminLoginForm;
		

		if(\Yii::$app->request->post()) {
			$post = $_POST;
			$userObject = new \app\models\User;

			if(isset($post['CustomerLoginForm'])) {
				$customerLoginForm->securityKey = \Yii::$app->params['user']['securityKey']; 
				$customerLoginForm->user = $userObject;
				$customerLoginForm->email = $post['CustomerLoginForm']['email'];
				$customerLoginForm->password = $post['CustomerLoginForm']['password'];

				if($customerLoginForm->validate()) {
					$customerLoginForm->login();
					$this->redirect(\Yii::$app->urlManager->createUrl('user/crud/dashboard'));
				}
			}

			if(isset($post['DriverLoginForm'])) {
				$driverLoginForm->securityKey = \Yii::$app->params['user']['securityKey']; 
				$driverLoginForm->user = $userObject;
				$driverLoginForm->username = $post['DriverLoginForm']['username'];
				$driverLoginForm->password = $post['DriverLoginForm']['password'];

				if($driverLoginForm->validate()) {
					$driverLoginForm->login();
					$this->redirect(\Yii::$app->urlManager->createUrl('user/crud/dashboard'));
				}
			}

			if(isset($post['AdminLoginForm'])) {
				$adminLoginForm->securityKey = \Yii::$app->params['user']['securityKey']; 
				$adminLoginForm->user = $userObject;
				$adminLoginForm->username = $post['AdminLoginForm']['username'];
				$adminLoginForm->password = $post['AdminLoginForm']['password'];

				if($adminLoginForm->validate()) {
					$adminLoginForm->login();
					$this->redirect(\Yii::$app->urlManager->createUrl('user/crud/dashboard'));
				}
			}
		}

		$message = '';
		if(\Yii::$app->session->hasFlash('flash-message-display')) {
			$message = \Yii::$app->session->getFlash('flash-message-display');	
		}

		return $this->render('/login', [
			'customerLoginForm' => $customerLoginForm,
			'driverLoginForm' => $driverLoginForm,
			'adminLoginForm' => $adminLoginForm,
			'message' => $message,
		]);
	}
}