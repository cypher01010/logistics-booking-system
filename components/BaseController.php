<?php

namespace app\components;

use Yii;
use yii\web\Controller;

class BaseController extends Controller
{
	// value to be used for which is navigation is active
	public $activeNavigation = 'dashboard';
	public $layout = '/rrl';
	public $settings = array();
	public $driversList = array();
	public $statusList = array();
	public $mapSettings = array();

	public function beforeAction($action)
	{
		$this->setLayout('/rrl2');

		return parent::beforeAction($action);
	}

	/**
	 * Allow to set the active navigation on the sidebar
	 * 
	 * @param $navigation
	 */
	public function setActiveNavigation($navigation)
	{
		$this->activeNavigation = $navigation;
	}

	/**
	 * Setting the layout to display
	 *
	 * @param $layout
	 */
	public function setLayout($layout)
	{
		$this->layout = $layout;
	}

	/**
	 * Return the number formating of the system with decimal value
	 * 
	 * @param $number
	 * @param $decimal
	 * @return number format
	 */
	public function numberFormat($number, $decimal = 2)
	{
		return number_format($number, $decimal);
	}

	/**
	 * Send email
	 *
	 * @param $from
	 * @param $to
	 * @param $subject
	 * @param $message
	 * @param $transport
	 */
	public function mail($from, $to, $subject, $message, $transport)
	{
		$sendSMTPEmail = \Yii::$app->params['sendSMTPEmail'];

		if($sendSMTPEmail == true) {

			$mailer = \Yii::$app->mailer;
			$mailer->setTransport($transport);
			$reponse = $mailer->compose('//etc/email', [])
				->setFrom($from)
				->setTo($to)
				->setSubject($subject)
				->setHtmlBody($message)
				->send();
		}
	}

	/**
	 * Mail transport
	 */
	public function mailTransport($config)
	{
		//$mailerSettings = $this->siteSettings(array('smtp'));

		return [
			'class' => 'Swift_SmtpTransport',
			'host' => $config['host'],
			'username' => $config['username'],
			'password' => $config['password'],
			'port' => $config['port'],
			'encryption' => $config['encryption'],
		];
	}

	/**
	 * Get the settings by passing group
	 */
	public function siteSettings($group = array())
	{
		$settingsObject = new \app\models\Settings;
		$settingsList = $settingsObject->byGroup($group);
		return $settingsList;
	}

	public function userAgent()
	{
		return $_SERVER['HTTP_USER_AGENT'];
	}

	public function ip()
	{
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$exploded = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			return $exploded[0];
		} else {
			return $_SERVER['REMOTE_ADDR'];
		}
	}

	public function filterHttps($actions)
	{
		if(Yii::$app->params['enforceHTTPS'] == true && is_array($actions)) {
			if($actions[0] == '*' && isset($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] == 80) {
				$url = 'https://' . $_SERVER['SERVER_NAME'] . \Yii::$app->request->url;
				$this->redirect($url);
			} else if(in_array(Yii::$app->controller->action->id, $actions) && isset($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] == 80) {
				$url = 'https://' . $_SERVER['SERVER_NAME'] . \Yii::$app->request->url;
				$this->redirect($url);
			}
		}
	}

	/**
	 * user security key
	 * @return settings value
	 */
	public function userSecurityKey()
	{
		return \Yii::$app->params['user']['securityKey'];
	}

	/**
	 * Return the system date
	 * @return system date
	 */
	public function systemDate()
	{
		return date(\Yii::$app->params['dateFormat']['standard'], time());
	}

	/**
	 * Return the date format of date
	 *
	 * @return date format
	 */
	public function dateFormatDisplay()
	{
		return \Yii::$app->params['dateFormat']['display'];
	}

	public function isMobile()
	{
		$path = realpath(dirname(__FILE__))
				. DIRECTORY_SEPARATOR . '..'
				. DIRECTORY_SEPARATOR . 'vendor'
				. DIRECTORY_SEPARATOR . 'ismobile'
				. DIRECTORY_SEPARATOR . 'ismobile.class.php';
		require_once($path);

		$ismobile = new \IsMobile();
		if($ismobile->CheckMobile()) {
			return true;
		}

		return false;
	}

	public function getDriversList()
	{
		if(is_array($this->driversList) && empty($this->driversList)) {
			$modelUser = new \app\models\User;
			$record = $modelUser->getRecordByUserType('driver');
			$list = [];
			$list[] = '(driver)';
			foreach ($record as $key => $value) {
				$list[$value['id']] = $value['name'];
			}
			$this->driversList = $list;
		}

		return $this->driversList;
	}

	public function completeStatusList()
	{
		if(is_array($this->statusList) && empty($this->statusList)) {
			$deliveryObject = new \app\models\Delivery;
			$this->statusList = $deliveryObject->statusList();
		}

		return $this->statusList;
	}

	public function deliveryTimeList()
	{
		$deliveryObject = new \app\models\Delivery;
		return $deliveryObject->deliveryTimeList();
	}

	/**
	 * Generate Identifier
	 * @return string identifier
	 */
	public function generateIdentifier()
	{
		$generated = rand(1, 9) . md5(uniqid() . rand() * rand(0, 9) * date('Y') . time() . mt_rand());

		return substr($generated, 1, 16);
	}

	public function getMapSettings()
	{
		if(is_array($this->mapSettings) && empty($this->mapSettings)) {
			$this->mapSettings = $this->siteSettings(['map']);
		}

		return $this->mapSettings;
	}
}