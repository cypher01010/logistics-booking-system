<?php
namespace app\modules\user\controllers;

class InfoController extends \app\components\BaseController
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => \yii\filters\AccessControl::className(),
				'only' => ['index', 'password'],
				'rules' => [
					[
						'allow' => true,
						'matchCallback' => function() {
							$id = \Yii::$app->session->get('id');
							return !empty($id);
						},
					],
				],
			],
		];
	}

	public function actionIndex()
	{
		$id = \Yii::$app->session->get('id');

		$this->setLayout('/backend');
		$this->setActiveNavigation('settings');

		$user = $this->findModel($id);
		$userobjectForm = NULL;
		$name = $user->name;
		$message = '';

		if($user->type == \app\models\User::USERTYPE_CUSTOMER) {
			$userobjectForm = new \app\modules\user\forms\UpdateCustomerForm;
			$userobjectForm->companyName = $user->name;
			$userobjectForm->companyPhone = $user->company_phone;
			$userobjectForm->postalCode = $user->zip_code;
			$userobjectForm->street = $user->address1;
			$userobjectForm->buildingName = $user->building_name;
			$userobjectForm->unitNumber = $user->unit_number;
			$userobjectForm->contactPerson = $user->contact_person;
			$userobjectForm->contactNumber = $user->contact_number;
		} else {
			$userobjectForm = new \app\modules\user\forms\UpdateUserForm;
			$userobjectForm->name = $user->name;
		}

		$userobjectForm->id = $user->id;
		$userobjectForm->email = $user->email;
		$userobjectForm->username = $user->username;
		$userobjectForm->type = $user->type;

		if(\Yii::$app->request->post()) {
			$userObject = new \app\models\User;
			$post = array();

			if($user->type == \app\models\User::USERTYPE_CUSTOMER) {
				$post = $_POST['UpdateCustomerForm'];
				$userobjectForm->companyName = $post['companyName'];
				$userobjectForm->companyPhone = $post['companyPhone'];
				$userobjectForm->postalCode = $post['postalCode'];
				$userobjectForm->street = $post['street'];
				$userobjectForm->buildingName = $post['buildingName'];
				$userobjectForm->unitNumber = $post['unitNumber'];
				$userobjectForm->contactPerson = $post['contactPerson'];
				$userobjectForm->contactNumber = $post['contactNumber'];
			} else {
				$post = $_POST['UpdateUserForm'];
				$userobjectForm->name = $post['name'];
				$userobjectForm->username = $post['username'];
			}

			$userobjectForm->email = $post['email'];
			$userobjectForm->userObject = $userObject;

			if($userobjectForm->validate()) {
				$dateUpdated = $this->systemDate();

				if($user->type == \app\models\User::USERTYPE_CUSTOMER) {
					$userObject->updateInfo(
						$user->id,
						'',
						$userobjectForm->companyName,
						$userobjectForm->email,
						'',
						$userobjectForm->street,
						$userobjectForm->postalCode,
						$dateUpdated,
						$userobjectForm->companyPhone,
						$userobjectForm->buildingName,
						$userobjectForm->unitNumber,
						$userobjectForm->contactPerson,
						$userobjectForm->contactNumber
					);

					\Yii::$app->session->set('name', $userobjectForm->companyName);
				} else {
					$userObject->updateInfo(
						$user->id,
						$userobjectForm->username,
						$userobjectForm->name,
						$userobjectForm->email,
						'',
						'',
						'',
						$dateUpdated,
						'',
						'',
						'',
						'',
						''
					);

					\Yii::$app->session->set('name', $userobjectForm->name);
					\Yii::$app->session->set('email', $userobjectForm->email);
				}

				$message = 'Personal Info is now updated.';
			}
		}

		return $this->render('index', [
			'model' => $userobjectForm,
			'name' => $name,
			'message' => $message,
		]);
	}

	public function actionPassword()
	{
		$this->setLayout('/backend');
		$this->setActiveNavigation('settings');
		$message = '';

		$passwordForm = new \app\modules\user\forms\PasswordForm;

		if(\Yii::$app->request->post()) {
			$post = $_POST['PasswordForm'];

			$passwordForm->username = \Yii::$app->session->get('username');
			$passwordForm->email = \Yii::$app->session->get('email');
			$passwordForm->type = \Yii::$app->session->get('type');
			$passwordForm->securityKey = \Yii::$app->params['user']['securityKey'];
			$passwordForm->old = $post['old'];
			$passwordForm->new = $post['new'];
			$passwordForm->confirm = $post['confirm'];
			$passwordForm->userObject = new \app\models\User;

			if($passwordForm->validate()) {
				$password = $passwordForm->userObject->encryptPassword($passwordForm->confirm, $passwordForm->hash, \Yii::$app->params['user']['securityKey']);
				$passwordForm->userObject->updatePassword(\Yii::$app->session->get('id'), $password);

				$message = 'Password is now updated.';
			}
		}

		$passwordForm->old = NULL;
		$passwordForm->new = NULL;
		$passwordForm->confirm = NULL;

		return $this->render('password', array(
			'model' => $passwordForm,
			'message' => $message,
		));
	}

	protected function findModel($id)
	{
		if (($model = \app\models\User::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}