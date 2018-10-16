<?php
namespace app\modules\user\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use app\models\Delivery;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ListController extends \app\components\BaseController
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => \yii\filters\AccessControl::className(),
				'only' => ['index', 'daterecord', 'dateurl'],
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

	public function actionIndex($type = 'all')
	{
		$this->setLayout('/backend');
		$this->setActiveNavigation('user-superadmin');

		$searchModel = new UserSearch();

		$render = 'index';
		switch ($type) {
			case 'customer':
				$render = 'customer';
				$dataProvider = $searchModel->searchCustomer(Yii::$app->request->queryParams);
				break;
			case 'driver':
				$render = 'driver';
				$dataProvider = $searchModel->searchDriver(Yii::$app->request->queryParams);
				break;
			default:
				$render = 'index';
				if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_SUPER_ADMIN) {
					$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
				} else {
					$dataProvider = $searchModel->searchAdmin(Yii::$app->request->queryParams);
				}
				break;
		}

		return $this->render($render, [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	public function actionDaterecord()
	{
		if(!Yii::$app->request->post()) {
			$this->redirect(Yii::$app->urlManager->createUrl('site/index'));
		}

		$response = array();

		if(isset($_POST['date']) && isset($_POST['_csrf'])) {
			$date = date('Y-m-d', strtotime($_POST['date']));
			$modelDelivery = new Delivery();

			$list = [];
			switch (\Yii::$app->session->get('type')) {
				case \app\models\User::USERTYPE_SUPER_ADMIN:
				case \app\models\User::USERTYPE_ADMIN:
					$list = $modelDelivery->getDeliveryByDate($date);
					break;
				case \app\models\User::USERTYPE_CUSTOMER:
					$list = $modelDelivery->getDeliveryByDateCustomer($date, 10, \Yii::$app->session->get('id'));
					break;
				case \app\models\User::USERTYPE_DRIVER:
					$list = $modelDelivery->getDeliveryByDateDriver($date, 10, \Yii::$app->session->get('id'));
					break;
				default:
					$list = $modelDelivery->getDeliveryByDate($date);
					break;
			}

			$response['date'] = date($this->dateFormatDisplay(), strtotime($date));
			$response['html'] = $this->renderAjax('//../modules/user/views/list/daterecord', array('list' => $list));
		}

		echo json_encode($response);
	}

	public function actionDateurl()
	{
		if(!Yii::$app->request->post()) {
			$this->redirect(Yii::$app->urlManager->createUrl('site/index'));
		}

		$response = array();
		$response['status'] = false;

		if(isset($_POST['date']) && isset($_POST['_csrf'])) {
			$date = date('d/m/Y', strtotime($_POST['date']));

			$response['status'] = true;
			$response['url'] = Yii::$app->urlManager->createUrl(['delivery/crud/index', 'DeliverySearch[date_delivery]' => $date]);
		}

		echo json_encode($response);
	}
}