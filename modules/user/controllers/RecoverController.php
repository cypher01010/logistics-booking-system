<?php
namespace app\modules\user\controllers;

class RecoverController extends \app\components\BaseController
{
	public function beforeAction($event)
	{
		$this->filterHttps(['*']);

		return parent::beforeAction($event);
	}

	public function actionIndex()
	{
		$id = \Yii::$app->session->get('id');
		if(!empty($id)) {
			$this->redirect(\Yii::$app->urlManager->createUrl('user/crud/dashboard'));
		}
		$this->setLayout('/recover');
		$recoverForm = new \app\modules\user\forms\RecoverForm;
		$recoverForm->userObject = new \app\models\User;

		if(\Yii::$app->request->post()) {
			$recoverForm->load(\Yii::$app->request->post());

			if($recoverForm->validate()) {
				$userInfo = $recoverForm->userInfo;

				$recoveryKey = $recoverForm->userObject->randomCharacters(32, 64);
				$recoveryUrl = \Yii::$app->urlManager->createAbsoluteUrl(['user/recover/reset',  'key' => $recoveryKey]);

				$recoverForm->userObject->updateRecoveryKey($userInfo['id'], $recoveryKey);

				$recoveryMessage =
				'
					Dear ' . $userInfo['name'] . ',<br />
					Click the link below to reset your password.<br />
					<br />
					Below is the recovery password URL.<br />
					Recovery Password URL : ' . $recoveryUrl  . '<br />
					<br />
					Regards,<br />
					The RichResources Team
				';
				$recoveryMessage = trim($recoveryMessage);

				$settings = $this->siteSettings(array('smtp', 'email'));
				$from = $settings['email']['noreply'];
				$to = $userInfo['email'];
				$subject = 'You requested a new password';

				$this->mail(
					$from,
					$to,
					$subject,
					$recoveryMessage,
					$this->mailTransport($settings['smtp'])
				);

				\Yii::$app->getSession()->setFlash('flash-message-display', 'Please check your inbox, we have sent an email to reset your password.');
				$this->redirect(\Yii::$app->urlManager->createUrl('user/login/index'));
			}
		}
		
		return $this->render('index', array(
			'recoverForm' => $recoverForm
		));
	}

	public function actionReset($key =  '')
	{
		$id = \Yii::$app->session->get('id');
		if(!empty($id)) {
			$this->redirect(\Yii::$app->urlManager->createUrl('user/crud/dashboard'));
		}
		$this->setLayout('/recover');
		$resetForm = new \app\modules\user\forms\ResetForm;
		$resetForm->userObject = new \app\models\User;
		$user = $resetForm->userObject->findByRecoveryKey($key);

		if(empty($user) || $key == '' || $key == null) {
			$this->redirect(\Yii::$app->urlManager->createUrl('site/index'));
		}

		if(\Yii::$app->request->post()) {
			$resetForm->load(\Yii::$app->request->post());
			if($resetForm->validate()) {
				$hash = $resetForm->userObject->hash();
				$password = $resetForm->userObject->encryptPassword($resetForm->new_password, $hash, \Yii::$app->params['user']['securityKey']);
				$resetForm->userObject->updateRecoveredPassword($user['id'], $hash, $password);

				\Yii::$app->getSession()->setFlash('flash-message-display', 'Youre password is now reset, you may use your new password to login.');
				$this->redirect(\Yii::$app->urlManager->createUrl('user/login/index'));
			}
		}

		return $this->render('/recover/reset', array(
			'resetForm' => $resetForm,
		));
	}
}