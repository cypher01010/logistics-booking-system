<?php
namespace app\modules\user\controllers;

class RegisterController extends \app\components\BaseController
{
	public function actionIndex()
	{
		$id = \Yii::$app->session->get('id');
		if(!empty($id)) {
			$this->redirect(\Yii::$app->urlManager->createUrl('user/crud/dashboard'));
		}
		$this->setLayout('/register');
		$registerForm = new \app\modules\user\forms\RegisterForm;

		if(\Yii::$app->request->post()) {
			$post = $_POST['RegisterForm'];
			$userObject = new \app\models\User;

			$registerForm->companyName = $post['companyName'];
			$registerForm->companyPhone = $post['companyPhone'];
			$registerForm->postalCode = $post['postalCode'];
			$registerForm->street = $post['street'];
			$registerForm->buildingName = $post['buildingName'];
			$registerForm->unitNumber = $post['unitNumber'];
			$registerForm->contactPerson = $post['contactPerson'];
			$registerForm->contactNumber = $post['contactNumber'];
			$registerForm->email = $post['email'];
			$registerForm->password = $post['password'];

			$registerForm->userObject = $userObject;

			if($registerForm->validate()) {
				$hash = $userObject->hash();
				$password = $userObject->encryptPassword($registerForm->password, $hash, \Yii::$app->params['user']['securityKey']);
				$dateCreated = $this->systemDate();

				$userObject->addRecord(
					'',
					$registerForm->companyName,
					$registerForm->email,
					$password,
					$hash,
					'customer',
					$dateCreated,
					'active',
					$registerForm->street,
					'',
					'',
					'',
					'',
					$registerForm->postalCode,
					'no',
					'',
					$registerForm->companyPhone,
					$registerForm->buildingName,
					$registerForm->unitNumber,
					$registerForm->contactPerson,
					$registerForm->contactNumber,
					'company'
				);

				\Yii::$app->getSession()->setFlash('flash-message-display', 'You have successfully registered as a user of our delivery system. Login to book a delivery slot. Thank you.');
				$this->redirect(\Yii::$app->urlManager->createUrl('user/login/index'));
			}
		}

		return $this->render('index', [
			'model' => $registerForm,
		]);
	}
}