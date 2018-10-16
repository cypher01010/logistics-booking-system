<?php
namespace app\modules\delivery\controllers;

use Yii;
use app\models\UploadForm;
use app\models\CsvForm;
use app\models\Vehicle;
use app\models\Delivery;
use app\models\User;
use app\models\DeliverySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

use yii\web\UploadedFile;

/**
 * CrudController implements the CRUD actions for Delivery model.
 */
class CrudController extends \app\components\BaseController
{
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post', 'get'],
				],
			],
			'access' => [
				'class' => \yii\filters\AccessControl::className(),
				'only' => ['index', 'view', 'create', 'update', 'delete', 'signature', 'pdf', 'updatedriver', 'updatestatus', 'recordsort', 'savesort', 'import'],
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

	/**
	 * Lists all Delivery models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$this->setLayout('/backend');
		$this->setActiveNavigation('delivery-page');
		$params = \Yii::$app->request->queryParams;

		$sortId = '-id';
		if(isset($_GET['sort']) && ($_GET['sort'] === 'id' || $_GET['sort'] === '-id')) {
			$sortId = ($_GET['sort'] === 'id') ? '-id' : 'id';
			$params['sort'] = $sortId;
		}

		$sortDateDelivery = '-date_delivery';
		if(isset($_GET['sort']) && ($_GET['sort'] === 'date_delivery' || $_GET['sort'] === '-date_delivery')) {
			$sortDateDelivery = ($_GET['sort'] === 'date_delivery') ? '-date_delivery' : 'date_delivery';
			$params['sort'] = $sortDateDelivery;
		}

		$sortDateTime = '-delivery_time';
		if(isset($_GET['sort']) && ($_GET['sort'] === 'delivery_time' || $_GET['sort'] === '-delivery_time')) {
			$sortDateTime = ($_GET['sort'] === 'delivery_time') ? '-delivery_time' : 'delivery_time';
			$params['sort'] = $sortDateTime;
		}

		$sortImageSignature = '-image_signature';
		if(isset($_GET['sort']) && ($_GET['sort'] === 'image_signature' || $_GET['sort'] === '-image_signature')) {
			$sortImageSignature = ($_GET['sort'] === 'image_signature') ? '-image_signature' : 'image_signature';
			$params['sort'] = $sortImageSignature;
		}

		$sortStatus = '-status';
		if(isset($_GET['sort']) && ($_GET['sort'] === 'status' || $_GET['sort'] === '-status')) {
			$sortStatus = ($_GET['sort'] === 'status') ? '-status' : 'status';
			$params['sort'] = $sortStatus;
		}

		$sortDriver = '-driver_id';
		if(isset($_GET['sort']) && ($_GET['sort'] === 'driver_id' || $_GET['sort'] === '-driver_id')) {
			$sortDriver = ($_GET['sort'] === 'driver_id') ? '-driver_id' : 'driver_id';
			$params['sort'] = $sortDriver;
		}

		$sortPostal = '-postal_code';
		if(isset($_GET['sort']) && ($_GET['sort'] === 'postal_code' || $_GET['sort'] === '-postal_code')) {
			$sortPostal = ($_GET['sort'] === 'postal_code') ? '-postal_code' : 'postal_code';
			$params['sort'] = $sortPostal;
		}

		$filtering = [];
		if(isset($params['DeliverySearch']) && is_array($params['DeliverySearch'])) {
			$filtering = $params['DeliverySearch'];
			if(isset($filtering['driver_id']) && $filtering['driver_id'] == 0) {
				unset($filtering['driver_id']);
			}
			if(isset($filtering['status']) && $filtering['status'] == '') {
				unset($filtering['status']);
			}

			if(isset($filtering['date_delivery']) && $filtering['date_delivery'] != '' && strpos($filtering['date_delivery'], '/') !== false) {
				$explodedDate = explode('/', $filtering['date_delivery']);
				$date = $explodedDate[1] . '/' . $explodedDate[0] . '/' . $explodedDate[2];
				$filtering['date_delivery'] = date("Y-m-d", strtotime($date));
			} else {
				unset($filtering['date_delivery']);
			}

			if(isset($filtering['delivery_time']) && $filtering['delivery_time'] == '') {
				unset($filtering['delivery_time']);
			}

			$params['DeliverySearch'] = $filtering;
		}

		$searchModel = new DeliverySearch();
		$dataProvider = $searchModel->search($params);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
			'sortId' => $sortId,
			'sortDateDelivery' => $sortDateDelivery,
			'sortDateTime' => $sortDateTime,
			'sortImageSignature' => $sortImageSignature,
			'sortStatus' => $sortStatus,
			'sortDriver' => $sortDriver,
			'isMobile' => $this->isMobile(),
			'filtering' => $filtering,
			'sortPostal' => $sortPostal,
		]);
	}

	/**
	 * Displays a single Delivery model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		$this->setLayout('/backend');
		$this->setActiveNavigation('delivery-page');

		$userObject = new \app\models\User;
		$delivery = $this->findModel($id);

		$sessionId = \Yii::$app->session->get('id');
		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_DRIVER && $delivery->driver_id != $sessionId) {
			return $this->redirect(\Yii::$app->urlManager->createUrl(['delivery/crud/index' , 'sort' => '-date_delivery']));
		}
		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_CUSTOMER && $delivery->customer_id != $sessionId) {
			return $this->redirect(\Yii::$app->urlManager->createUrl(['delivery/crud/index' , 'sort' => '-date_delivery']));
		}

		return $this->render('view', [
			'model' => $delivery,
			'userObject' => $userObject,
		]);
	}

	public function actionPdf($id)
	{
		$path = realpath(dirname(__FILE__))
				. DIRECTORY_SEPARATOR . '..'
				. DIRECTORY_SEPARATOR . '..'
				. DIRECTORY_SEPARATOR . '..'
				. DIRECTORY_SEPARATOR . 'vendor'
				. DIRECTORY_SEPARATOR . 'mpdf'
				. DIRECTORY_SEPARATOR . 'mpdf'
				. DIRECTORY_SEPARATOR . 'mpdf.php';
		require_once($path);

		$mpdf = new \mPDF();

		$delivery = $this->findModel($id);

		$sessionId = \Yii::$app->session->get('id');
		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_DRIVER && $delivery->driver_id != $sessionId) {
			return $this->redirect(\Yii::$app->urlManager->createUrl(['delivery/crud/index' , 'sort' => '-date_delivery']));
		}
		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_CUSTOMER && $delivery->customer_id != $sessionId) {
			return $this->redirect(\Yii::$app->urlManager->createUrl(['delivery/crud/index' , 'sort' => '-date_delivery']));
		}

		$html = $this->renderPartial('pdf', [
			'model' => $delivery,
			'userObject' => new \app\models\User,
		]);

		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}
    
    public function actionImport(){
        $this->setLayout('/backend');
		$this->setActiveNavigation('delivery-page');
        
		$model = new CsvForm();
        $modelDelivery = new Delivery();
        
        if($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model,'file');
            $filename = 'Data.'.$file->extension;
            $upload = $file->saveAs('uploads/'.$filename);
            if($upload){
                define('CSV_PATH','uploads/');
                $csv_file = CSV_PATH . $filename;
                $filecsv = file($csv_file);
                
                $counter = 0; // Escape the header
                foreach($filecsv as $data){
                    $delivery = explode(",", $data);
                    if($counter != 0){
      
                        $params['customer_id'] = trim($delivery[0]);
                        $params['sender_name'] = trim($delivery[1]);
                        $params['sender_company'] = trim($delivery[2]);
                        $params['sender_contact'] = trim($delivery[3]);
                        $params['sender_postal_code'] = trim($delivery[4]);
                        $params['sender_blk_street_name'] = trim($delivery[5]);
                        $params['sender_bldg_name'] = trim($delivery[6]);
                        $params['sender_unit_no'] = trim($delivery[7]);
                        $params['receiver_name'] = trim($delivery[8]);
                        $params['receiver_company'] = trim($delivery[9]);
                        
                        //$params['tracking_id'] = '123';
                        //$params['delivery_book_id'] = '456';
                        
                        $params['tracking_id'] = $this->generateIdentifier();
                        $params['delivery_book_id'] = $this->generateIdentifier();
                        
                        $params['date_delivery'] = trim($delivery[10]);
                        $params['delivery_time'] = trim($delivery[11]);
                        $params['receiver_contact'] = trim($delivery[12]);
                        $params['postal_code'] = trim($delivery[13]);
                        $params['blk_street_name'] = trim($delivery[14]);
                        $params['bldg_name'] = trim($delivery[15]);
                        $params['unit_no'] = trim($delivery[16]);
                        $params['type_products'] = trim($delivery[17]);
                        $params['cartoon_size'] = trim($delivery[18]);
                        $params['cartoon_weight'] = trim($delivery[19]);
                        $params['no_cartoons'] = trim($delivery[20]);
                        $params['driver_id'] = trim($delivery[21]);
                        $params['status'] = trim($delivery[22]);  

                        $modelDelivery->addRecordByArray($params);
                    }
                    $counter++;
                }
              
                unlink('uploads/'.$filename);
                $this->redirect(\Yii::$app->urlManager->createUrl(['delivery/crud/index','sort' => '-id']));
            }
        }else{
            return $this->render('import',['model'=>$model]);
        }
    }

	/**
	 * Creates a new Delivery model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_DRIVER) {
			$this->redirect(\Yii::$app->urlManager->createUrl('user/crud/dashboard'));
		}

		$this->setLayout('/backend');
		$this->setActiveNavigation('delivery-page');

		$userid = \Yii::$app->session->get('id');

		$modelDelivery = new Delivery();
		$deliveryForm = new \app\modules\delivery\forms\DeliveryForm;
		$deliveryForm->tracking_id = $this->generateIdentifier();
		$deliveryForm->delivery_book_id = $this->generateIdentifier();
		$deliveryForm->date_delivery = date(\Yii::$app->controller->dateFormatDisplay(), time());

		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_CUSTOMER) {
			$deliveryForm->customer_id = \Yii::$app->session->get('id');
		}

		if(\Yii::$app->request->post()) {
			$post = $_POST;
			$file = $_FILES;

			$path = '';
			if(isset($file['DeliveryForm']) && isset($file['DeliveryForm']['name']) && !empty($file['DeliveryForm']['name']['document'])) {
				$filename = time() . '-' . $userid . '-' . $file['DeliveryForm']['name']['document'];
				$deliveryForm->document = addslashes($filename);
				$post['DeliveryForm']['document'] = $deliveryForm->document;
				$path = $this->documentPath() . $filename;
			}

			$deliveryForm->load($post);
			if($deliveryForm->validate()) {
				if($path != '') {
					$documentFileContent = file_get_contents($file['DeliveryForm']['tmp_name']['document']);
					$fh = fopen($path, "a");
					fwrite($fh, $documentFileContent);
					fclose($fh);
				}

				if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_CUSTOMER) {
					$post['DeliveryForm']['status'] = 'requested';
					$post['DeliveryForm']['customer_id'] = \Yii::$app->session->get('id');
				}

				if($deliveryForm->date_delivery != '' && strpos($deliveryForm->date_delivery, '/') !== false) {
					$explodedDate = explode('/', $deliveryForm->date_delivery);
					$date = $explodedDate[1] . '/' . $explodedDate[0] . '/' . $explodedDate[2];
					$post['DeliveryForm']['date_delivery'] = date("Y-m-d", strtotime($date));
				}

				$post['DeliveryForm']['date_created'] = date("Y-m-d", time());

				$id = $modelDelivery->addRecordByArray($post['DeliveryForm']);
				return $this->redirect(['view', 'id' => $id]);
			}
		}

		$modelUser = new User();
		$driver = $modelUser->getRecordByUserType('driver');
		$customer = $modelUser->getRecordByUserType('customer');
		$modelVehicle = new Vehicle();
		$modelDriver = ArrayHelper::map($driver, 'id', 'name');
		$modelCustomer = ArrayHelper::map($customer, 'id', 'name');
		$statusList = $modelDelivery->adminStatusListCreate();
		$vehicle = $modelVehicle->find()->select(['code','vehicle_no'])->asArray()->all();
		$vehicleMap = ArrayHelper::map($vehicle,'code','vehicle_no');

		return $this->render('create', [
			'model' => $deliveryForm,
			'modelVehicle' => $vehicleMap,
			'modelDriver' => $modelDriver,
			'modelCustomer' => $modelCustomer,
			'statusList' => $statusList,
		]);
	}

	/**
	 * Updates an existing Delivery model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$this->setLayout('/backend');
		$this->setActiveNavigation('delivery-page');

		$userid = \Yii::$app->session->get('id');

		$modelDelivery = new Delivery();
		$deliveryForm = new \app\modules\delivery\forms\DeliveryForm;
		$model = $this->findModel($id);
		$updateData = array(
			'DeliveryForm' => array(),
		);

		$sessionId = \Yii::$app->session->get('id');
		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_DRIVER && $model->driver_id != $sessionId) {
			return $this->redirect(\Yii::$app->urlManager->createUrl(['delivery/crud/index' , 'sort' => '-date_delivery']));
		}
		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_CUSTOMER && $model->customer_id != $sessionId) {
			return $this->redirect(\Yii::$app->urlManager->createUrl(['delivery/crud/index' , 'sort' => '-date_delivery']));
		}
		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_CUSTOMER && $model->status == 'cancelled') {
			return $this->redirect(\Yii::$app->urlManager->createUrl(['delivery/crud/view' , 'id' => $id]));
		}
		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_CUSTOMER && $model->status == 'delivered') {
			return $this->redirect(\Yii::$app->urlManager->createUrl(['delivery/crud/view' , 'id' => $id]));
		}

		foreach ($model as $key => $value) {
			$deliveryForm->$key = $value;
			$updateData['DeliveryForm'][$key] = $value;
		}
		$deliveryForm->date_delivery = date(\Yii::$app->controller->dateFormatDisplay(), strtotime($deliveryForm->date_delivery));

		if(\Yii::$app->request->post()) {
			$post = $_POST;
			$file = $_FILES;

			$path = '';
			if(isset($file['DeliveryForm']) && isset($file['DeliveryForm']['name']) && !empty($file['DeliveryForm']['name']['document'])) {
				$filename = time() . '-' . $userid . '-' . $file['DeliveryForm']['name']['document'];
				$deliveryForm->document = addslashes($filename);
				$post['DeliveryForm']['document'] = $deliveryForm->document;
				$path = $this->documentPath() . $filename;
			}

			$deliveryForm->load($post);
			if($deliveryForm->validate()) {
				if($path != '') {
					$documentFileContent = file_get_contents($file['DeliveryForm']['tmp_name']['document']);
					$fh = fopen($path, "a");
					fwrite($fh, $documentFileContent);
					fclose($fh);
				}

				if(isset($post['DeliveryForm']) && isset($post['DeliveryForm']['signaturePad']) && !empty($post['DeliveryForm']['signaturePad'])) {
					$signaturePad = str_replace('data:image/png;base64,', '', $post['DeliveryForm']['signaturePad']);
					$signaturePad = str_replace(' ', '+', $signaturePad);
					$signaturePad = base64_decode($signaturePad);

					$filename = time() . '-' . $id . '.png';
					$path = $this->signaturePath() . $filename;

					$fh = fopen($path, "a");
					fwrite($fh, $signaturePad);
					fclose($fh);

					$updateData['DeliveryForm']['image_signature'] = $filename;
					unset($post['DeliveryForm']['signaturePad']);
				}

				if($deliveryForm->date_delivery != '' && strpos($deliveryForm->date_delivery, '/') !== false) {
					$explodedDate = explode('/', $deliveryForm->date_delivery);
					$date = $explodedDate[1] . '/' . $explodedDate[0] . '/' . $explodedDate[2];
					$post['DeliveryForm']['date_delivery'] = date("Y-m-d", strtotime($date));
				}

				foreach($post['DeliveryForm'] as $postKey => $postValue) {
					$postValue = trim($postValue);
					if($postKey == 'image_signature') {
						if($postValue != '') {
							$updateData['DeliveryForm'][$postKey] = $postValue;
						}
					} else if($postKey == 'document') {
						if($postValue != '') {
							$updateData['DeliveryForm'][$postKey] = $postValue;
						}
					} else {
						$updateData['DeliveryForm'][$postKey] = $postValue;
					}
				}

				$id = $updateData['DeliveryForm']['id'];
				unset($updateData['DeliveryForm']['id']);
				$modelDelivery->updateRecordByArray($id, $updateData['DeliveryForm']);
				return $this->redirect(['view', 'id' => $id]);
			}
		}

		$modelUser = new User();
		$driver = $modelUser->getRecordByUserType('driver');
		$customer = $modelUser->getRecordByUserType('customer');
		$modelVehicle = new Vehicle();
		$modelDriver = ArrayHelper::map($driver, 'id', 'name');
		$modelCustomer = ArrayHelper::map($customer, 'id', 'name');
		$statusList = $modelDelivery->statusList();
		$vehicle = $modelVehicle->find()->select(['code','vehicle_no'])->asArray()->all();
		$vehicleMap = ArrayHelper::map($vehicle,'code','vehicle_no');

		$settings = $this->siteSettings(['map']);

		return $this->render('update', [
			'model' => $deliveryForm,
			'modelVehicle' => $vehicleMap,
			'modelDriver' => $modelDriver,
			'modelCustomer' => $modelCustomer,
			'statusList' => $statusList,
			//'mapSettings' => $settings['map'],
		]);
	}

	/**
	 * Deletes an existing Delivery model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_ADMIN || \Yii::$app->session->get('type') == \app\models\User::USERTYPE_SUPER_ADMIN) {
			$this->findModel($id)->delete();
		}

		return $this->redirect(\Yii::$app->urlManager->createUrl(['delivery/crud/index' , 'sort' => '-date_delivery']));
	}

	/**
	 * Finds the Delivery model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Delivery the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Delivery::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function actionSignature($id)
	{
		$model = $this->findModel($id);
		$path = $this->signaturePath() . $model->image_signature;

		$sessionId = \Yii::$app->session->get('id');
		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_DRIVER && $model->driver_id != $sessionId) {
			die("no signature");
		}
		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_CUSTOMER && $model->customer_id != $sessionId) {
			die("no signature");
		}

		$display = false;
		if($model->image_signature == '') {
			$display = false;
		} else if(!file_exists($path)) {
			$display = false;
		} else {
			switch (\Yii::$app->session->get('type')) {
				case \app\models\User::USERTYPE_SUPER_ADMIN:
				case \app\models\User::USERTYPE_ADMIN:
					$display = true;
					break;
				case \app\models\User::USERTYPE_CUSTOMER:
					$id = \Yii::$app->session->get('id');
					if($id == $model->customer_id) {
						$display = true;
					}
					break;
				case \app\models\User::USERTYPE_DRIVER:
					$id = \Yii::$app->session->get('id');
					if($id == $model->driver_id) {
						$display = true;
					}
					break;
				default:
					$display = false;
					break;
			}
		}

		if($display == false) {
			die("no signature");
		}

		header("Content-Type: image/png");
		header('Content-Length: ' . filesize($path));
		header('Content-Disposition: inline; filename="$model->image_signature"');
		header("Accept-Ranges: bytes");

		readfile($path);
		die();
	}

	private function signaturePath()
	{
		return \Yii::$app->params['path']['signature'];
	}

	private function documentPath()
	{
		return \Yii::$app->params['path']['document'];
	}

	public function actionUpdatedriver()
	{
		if(!\Yii::$app->request->post()) {
			$this->redirect(Yii::$app->urlManager->createUrl('site/index'));
		}

		$response = array();
		$response['success'] = false;
		$proceed = false;

		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_ADMIN || \Yii::$app->session->get('type') == \app\models\User::USERTYPE_SUPER_ADMIN) {
			$proceed = true;
		}

		if($proceed == true && isset($_POST['_csrf']) && isset($_POST['driverId']) && isset($_POST['deliveryId'])) {
			$post = $_POST;

			$modelDelivery = new Delivery();
			$modelDelivery->updateRecordByArray($_POST['deliveryId'], array('driver_id' => $_POST['driverId']));
			$response['success'] = true;
		}

		echo json_encode($response);
	}

	public function actionUpdatestatus()
	{
		if(!\Yii::$app->request->post()) {
			$this->redirect(Yii::$app->urlManager->createUrl('site/index'));
		}

		$response = array();
		$response['success'] = false;
		$proceed = false;

		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_ADMIN || \Yii::$app->session->get('type') == \app\models\User::USERTYPE_SUPER_ADMIN) {
			$proceed = true;
		}

		if($proceed == true && isset($_POST['_csrf']) && isset($_POST['status']) && isset($_POST['deliveryId'])) {
			$post = $_POST;

			$modelDelivery = new Delivery();
			$modelDelivery->updateRecordByArray($_POST['deliveryId'], array('status' => $_POST['status']));
			$response['success'] = true;
		}

		echo json_encode($response);
	}

	public function actionCancel($id)
	{
		$delivery = $this->findModel($id);
		$sessionId = \Yii::$app->session->get('id');

		if($delivery->status == 'requested' || $delivery->status == 'allocated' || $delivery->status == 'failed') {
			if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_CUSTOMER && $sessionId == $delivery->customer_id) {
				$delivery->updateRecordByArray($delivery->id, ['status' => 'cancelled']);
			}
		}

		return $this->redirect(\Yii::$app->urlManager->createUrl(['delivery/crud/view' , 'id' => $id]));
	}

	public function actionRecordsort()
	{
		if(!\Yii::$app->request->post()) {
			$this->redirect(\Yii::$app->urlManager->createUrl('site/index'));
		}

		$response = array();
		$response['success'] = false;
		$proceed = false;

		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_ADMIN || \Yii::$app->session->get('type') == \app\models\User::USERTYPE_SUPER_ADMIN) {
			$proceed = true;
		}

		if($proceed == true && isset($_POST['driver']) && isset($_POST['_csrf'])) {
			$post = $_POST;

			$condition = array();

			if(isset($_POST['date']) && $post['date'] != '' && strpos($post['date'], '/') !== false) {
				$explodedDate = explode('/', $post['date']);
				$date = $explodedDate[1] . '/' . $explodedDate[0] . '/' . $explodedDate[2];
				$condition['date_delivery'] = date("Y-m-d", strtotime($date));
			}

			if(isset($_POST['time']) && $post['time'] != '') {
				$condition['delivery_time'] = $post['time'];
			}

			if(isset($_POST['driver']) && $post['driver'] != '') {
				$condition['driver_id'] = (int)$post['driver'];
			}

			if(isset($_POST['status']) && $post['status'] != '') {
				$condition['status'] = $post['status'];
			}

			$deliveryModel = new Delivery();
			$data = $deliveryModel->getDriverDeliveryRecords($condition);

			$view = '/crud/sort/web';
			if($this->isMobile()) {
				$view = '/crud/sort/mobile';
			}

			$response['data'] = $data;
			$response['condition'] = $condition;
			$response['post'] = $post;
			$response['html'] = $this->renderAjax($view, ['delivery' => $data, 'statusList' => $deliveryModel->statusList()]);
			$response['success'] = true;
		}

		echo json_encode($response);
	}

	public function actionSavesort()
	{
		if(!\Yii::$app->request->post()) {
			$this->redirect(\Yii::$app->urlManager->createUrl('site/index'));
		}

		$response = array();
		$response['success'] = false;
		$proceed = false;

		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_ADMIN || \Yii::$app->session->get('type') == \app\models\User::USERTYPE_SUPER_ADMIN) {
			$proceed = true;
		}

		if($proceed == true && isset($_POST['sorting']) && isset($_POST['_csrf'])) {
			$post = $_POST;

			$prep = 'UPDATE `delivery` SET `delivery`.`delivery_ordering` = "{sortingNumber}" WHERE `delivery`.`id` = {deliveryId};';
			$sql = '';
			$deliveryModel = new Delivery();
			foreach($post['sorting'] as $sortingKey => $sortingValue) {
				$sql = $prep;

				$index = $sortingKey + 1;
				$sql = str_replace('{sortingNumber}', $index, $sql);
				$sql = str_replace('{deliveryId}', $sortingValue, $sql);

				$deliveryModel->updateDeliverySorting($sql);
			}

			$response['success'] = true;
		}

		echo json_encode($response);
	}
}