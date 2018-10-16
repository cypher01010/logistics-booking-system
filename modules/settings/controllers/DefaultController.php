<?php
namespace app\modules\settings\controllers;

class DefaultController extends \app\components\BaseController
{
	public function beforeAction($event)
	{
		$this->filterHttps(['*']);

		return parent::beforeAction($event);
	}

	public function behaviors()
	{
		return [
			'access' => [
				'class' => \yii\filters\AccessControl::className(),
				'only' => ['index', 'smtp', 'testsmtpsettings', 'cron'],
				'rules' => [
					[
						'allow' => true,
						'matchCallback' => function() {
							$id = \Yii::$app->session->get('id');
							$type = \Yii::$app->session->get('type');
							return !empty($id) && $type === \app\models\User::USERTYPE_SUPER_ADMIN;
						},
					],
				],
			],
		];
	}

	public function actionIndex()
	{
		$this->redirect(\Yii::$app->urlManager->createUrl('settings/default/smtp'));
	}

	public function actionSmtp()
	{
		$this->setLayout('/backend');
		$this->setActiveNavigation('system-settings');

		$settingsForm = new \app\modules\settings\forms\SMTPForm;
		$message = '';

		if(\Yii::$app->request->post()) {
			$post = $_POST['SMTPForm'];

			$settingsForm->host = $post['host'];
			$settingsForm->port = $post['port'];
			$settingsForm->username = $post['username'];
			$settingsForm->password = $post['password'];
			$settingsForm->encryption = $post['encryption'];
			$settingsForm->sender = $post['sender'];
			$settingsForm->testReceiver = $post['testReceiver'];

			if($settingsForm->validate()) {
				$settingsObject = new \app\models\Settings;
				$settingsObject->updateRecordValue('smtp', 'host', $settingsForm->host);
				$settingsObject->updateRecordValue('smtp', 'port', $settingsForm->port);
				$settingsObject->updateRecordValue('smtp', 'username', $settingsForm->username);
				$settingsObject->updateRecordValue('smtp', 'password', $settingsForm->password);
				$settingsObject->updateRecordValue('smtp', 'encryption', $settingsForm->encryption);
				$settingsObject->updateRecordValue('email', 'noreply', $settingsForm->sender);
				$settingsObject->updateRecordValue('email', 'test.receiver', $settingsForm->testReceiver);

				$message = 'SMTP Settings is now updated.';
			}
		}

		$settings = $this->siteSettings(array('smtp', 'email'));
		$settingsForm->host = $settings['smtp']['host'];
		$settingsForm->port = $settings['smtp']['port'];
		$settingsForm->username = $settings['smtp']['username'];
		$settingsForm->password = $settings['smtp']['password'];
		$settingsForm->encryption = $settings['smtp']['encryption'];
		$settingsForm->sender = $settings['email']['noreply'];
		$settingsForm->testReceiver = $settings['email']['test.receiver'];

		return $this->render('smtp', array(
			'settingsForm' => $settingsForm,
			'message' => $message,
		));
	}

	public function actionTestsmtpsettings()
	{
		if(!\Yii::$app->request->post()) {
			$this->redirect(Yii::$app->urlManager->createUrl('site/index'));
		}

		$response = array();
		$response['success'] = false;

		if(isset($_POST['_csrf']) && isset($_POST['host']) && isset($_POST['port']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['encryption'])) {
			$host = trim($_POST['host']);
			$port = trim($_POST['port']);
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);
			$encryption = trim($_POST['encryption']);
			$testreceiver = trim($_POST['testreceiver']);
			$sender = trim($_POST['sender']);

			$config = array(
				'host' => $host,
				'username' => $username,
				'password' => $password,
				'port' => $port,
				'encryption' => $encryption,
			);
			$transport = $this->mailTransport($config);


			$from = $sender;
			$to = $testreceiver;
			$subject = 'Testing SMTP Settings';
			$message = 'This is a testing email message';
			$response = $this->mail($from, $to, $subject, $message, $transport);

			$response['transport'] = $transport;
			$response['response'] = $response;
			$response['success'] = true;
		}

		echo json_encode($response);
	}

	public function actionCron()
	{
		$this->setLayout('/backend');
		$this->setActiveNavigation('system-settings');

		$settingsForm = new \app\modules\settings\forms\CronForm;
		$message = '';

		if(\Yii::$app->request->post()) {
			$post = $_POST;

			$settingsForm->load($post);
			if($settingsForm->validate()) {
				$settingsObject = new \app\models\Settings;
				$settingsObject->updateRecordValue('cron', 'hour', $settingsForm->time);
				$settingsObject->updateRecordValue('email', 'operation', $settingsForm->receiver);

				$message = 'Cron Settings is now updated.';
			}
		}

		$settings = $this->siteSettings(array('email', 'cron'));
		$settingsForm->time = $settings['cron']['hour'];
		$settingsForm->receiver = $settings['email']['operation'];

		return $this->render('cron', array(
			'settingsForm' => $settingsForm,
			'message' => $message,
		));
	}
}