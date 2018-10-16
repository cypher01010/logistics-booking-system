<?php
namespace app\modules\delivery\controllers;

class DefaultController extends \app\components\BaseController
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => \yii\filters\AccessControl::className(),
				'only' => ['index', 'calendar', 'registeredaddress'],
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

	public function beforeAction($action)
	{
		\Yii::$app->controller->enableCsrfValidation = false;

		return parent::beforeAction($action);
	}

	public function actionIndex()
	{
		return $this->render('index');
	}

	public function actionCalendar()
	{
		if(!\Yii::$app->request->post()) {
			$this->redirect(\Yii::$app->urlManager->createUrl('site/index'));
		}

		$deliveryObject = new \app\models\Delivery;

		$start = date('Y-m-d', $_POST['start']);
		$end = date('Y-m-d', $_POST['end']);

		$delivery = [];
		switch (\Yii::$app->session->get('type')) {
			case \app\models\User::USERTYPE_SUPER_ADMIN:
			case \app\models\User::USERTYPE_ADMIN:
				$delivery = $deliveryObject->getDeliveryPerMonth($start . ' 00:00:00', $end . ' 00:00:00');
				break;
			case \app\models\User::USERTYPE_CUSTOMER:
				$delivery = $deliveryObject->getDeliveryPerMonthCustomer(\Yii::$app->session->get('id'), $start . ' 00:00:00', $end . ' 00:00:00');
				break;
			case \app\models\User::USERTYPE_DRIVER:
				$delivery = $deliveryObject->getDeliveryPerMonthDriver(\Yii::$app->session->get('id'), $start . ' 00:00:00', $end . ' 00:00:00');
				break;
			default:
				$delivery = $deliveryObject->getDeliveryPerMonth($start . ' 00:00:00', $end . ' 00:00:00');
				break;
		}

		$deliveryList = array();

		foreach ($delivery as $dKey => $dValue) {
			$thisDelivery = array(
				'title' => $this->renderAjax('calendar', array('dValue' => $dValue)),
				'start' => date('Y-m-d', strtotime($dValue['date_delivery'])),
			);

			$deliveryList[] = $thisDelivery;
		}

		echo json_encode($deliveryList);
	}

	public function actionRegisteredaddress()
	{
		$userObject = new \app\models\User;  
		$id = '';

		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_CUSTOMER) {
			$id = \Yii::$app->session->get('id');
		} else if(isset($_POST['id'])) {
			$id = $_POST['id'];
		}

		$userData = $userObject->getRecordByIdArray($id); 
		return json_encode(array(
			'zip_code' => $userData['zip_code'],
			'address1' => $userData['address1'],
			'building_name' => $userData['building_name'],
			'unit_number' => $userData['unit_number'],
			'company' => $userData['name'],
			'sender' => $userData['contact_person'],
			'contact' => $userData['contact_number'],
		));
	}
	
	private function runCron($ymdDate, $fjyDate, $settings)
	{
		$deliveriesMessage = $this->buildMessage($ymdDate, $fjyDate);

		$from = $settings['email']['noreply'];
		$to = $settings['email']['operation'];
		
		$subject = 'Rich Resources Logistics [Book Delivery - '. $fjyDate . ']';

		$this->mail(
			$from,
			$to,
			$subject,
			$deliveriesMessage,
			$this->mailTransport($settings['smtp'])
		);
	}

	private function buildMessage($ymdDate, $fjyDate)
	{
		$deliveryObject = new \app\models\Delivery;
		$deliveries = $deliveryObject->createdToday(trim($ymdDate));

		$statusList = $this->completeStatusList();

		$title = '<h3>Book Delivery - '. $fjyDate .'</h3>';
		$opentable = '<table style="width:100%; border: 1px solid black; border-collapse: collapse;" >';

		$header = '
			<tr>
				<td style="border: 1px solid black; border-collapse: collapse;"><b>Delivery Date</b></td>
				<td style="border: 1px solid black; border-collapse: collapse;"><b>Delivery Timing</b></td>
				<td style="border: 1px solid black; border-collapse: collapse;"><b>Sender\'s Company</b></td>
				<td style="border: 1px solid black; border-collapse: collapse;"><b>Blk and Street Name</b></td>
				<td style="border: 1px solid black; border-collapse: collapse;"><b>Postal Code</b></td>
				<td style="border: 1px solid black; border-collapse: collapse;"><b>No. of carton(s)</b></td>
				<td style="border: 1px solid black; border-collapse: collapse;"><b>Status</b></td>				
			</tr>
		';

		$content = '';
		foreach($deliveries as $deliveries) {
			$status = 'No Status';
			if(isset($statusList[$deliveries['status']]) && $deliveries['status'] != '') {
				$status = $statusList[$deliveries['status']];
			}

			$content = $content . '<tr>';
				$content = $content . '<td style="border: 1px solid black; border-collapse: collapse;">' . date(\Yii::$app->controller->dateFormatDisplay(), strtotime($deliveries['date_delivery'])) . '</td>';
				$content = $content . '<td style="border: 1px solid black; border-collapse: collapse;">' . $deliveries['delivery_time'] . '</td>';
				$content = $content . '<td style="border: 1px solid black; border-collapse: collapse;">' . $deliveries['sender_company'] . '</td>';
				$content = $content . '<td style="border: 1px solid black; border-collapse: collapse;">' . $deliveries['blk_street_name'] . '</td>';
				$content = $content . '<td style="border: 1px solid black; border-collapse: collapse;">' . $deliveries['postal_code'] . '</td>';
				$content = $content . '<td style="border: 1px solid black; border-collapse: collapse;">' . $deliveries['no_cartoons'] . '</td>';
				$content = $content . '<td style="border: 1px solid black; border-collapse: collapse;">' . $status . '</td>';
			$content = $content . '</tr>';
		}

		$closetable = '</table>';
		$message = $title . $opentable . $header . $content . $closetable;

		return $message;
	}

	public function actionDailybookings()
	{
		date_default_timezone_set('Asia/Singapore');
		$epoch = time();
		$currentDate =  date("Y-m-d H:i:s", $epoch);
		$settings = $this->siteSettings(array('smtp', 'email', 'cron'));
		$targetHourRun = date("Y-m-d", $epoch) . ' ' . $settings['cron']['hour'] . ':' . date("s", $epoch);
		$epochCurrentDate = strtotime($currentDate);
		$epochTargetHourRun = strtotime($targetHourRun);

		if($epochCurrentDate >= $epochTargetHourRun) {
			if($settings['cron']['flag'] == \app\models\Settings::CRON_STATUS_LISTEN) {
				$proceed = false;
				$cronObject = new \app\models\Cron;
				$date = date("Y-m-d", time());

				$cronInfo = $cronObject->getRecord(['time' => $date]);

				if(!is_array($cronInfo) && empty($cronInfo)) {
					$proceed = true;
				}

				if($proceed == true) {
					$cronObject->addRecord([
						'time' => $date,
					]);

					$settingsObject = new \app\models\Settings;
					$settingsObject->updateRecordValue('cron', 'flag', \app\models\Settings::CRON_STATUS_RUNNING);

					$fjyDate = date("F j, Y", time());
					$this->runCron($date, $fjyDate, $settings);

					$settingsObject->updateRecordValue('cron', 'flag', \app\models\Settings::CRON_STATUS_LISTEN);
				}
			}
		}
	}
}