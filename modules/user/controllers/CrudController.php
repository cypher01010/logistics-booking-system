<?php
namespace app\modules\user\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use app\models\Delivery;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
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
				'only' => ['index', 'view', 'create', 'update', 'delete', 'dashboard', 'list'],
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
	 * Lists all User models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$this->setLayout('/backend');
		$this->setActiveNavigation('user-superadmin');

		$searchModel = new UserSearch();
		$dataProvider = NULL;

		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_SUPER_ADMIN) {
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		} else {
			$dataProvider = $searchModel->searchAdmin(Yii::$app->request->queryParams);
		}

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single User model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_DRIVER || \Yii::$app->session->get('type') == \app\models\User::USERTYPE_CUSTOMER) {
			return $this->redirect(\Yii::$app->urlManager->createUrl('site/index'));
		}

		$this->setLayout('/backend');
		$this->setActiveNavigation('user-superadmin');

		$user = $this->findModel($id);

		if($user->status == \app\models\User::STATUS_DELETE) {
			$type = \app\models\User::USERTYPE_CUSTOMER;
			switch ($user->type) {
				case \app\models\User::USERTYPE_SUPER_ADMIN:
				case \app\models\User::USERTYPE_ADMIN:
					$type = 'all';
					break;
				case \app\models\User::USERTYPE_DRIVER:
					$type = \app\models\User::USERTYPE_DRIVER;
					break;
			}
			$this->redirect(\Yii::$app->urlManager->createUrl(['user/crud/list', 'type' => $type]));
		}

		return $this->render('view', [
			'model' => $user,
		]);
	}

	/**
	 * Creates a new User model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate($tab = 'customer')
	{
		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_DRIVER || \Yii::$app->session->get('type') == \app\models\User::USERTYPE_CUSTOMER) {
			return $this->redirect(\Yii::$app->urlManager->createUrl('site/index'));
		}

		$this->setLayout('/backend');
		$this->setActiveNavigation('user-superadmin');
		
		$createUserFormObject = new \app\modules\user\forms\CreateUserForm;
		$createCustomerFormObject = new \app\modules\user\forms\CreateCustomerForm;
		
		$modelUser = new User();
		$numusers = array();
		
		$numusers['driver'] = count($modelUser->getRecordByUserType('driver'));
		$numusers['superadmin'] = count($modelUser->getRecordByUserType('superadmin'));
		$numusers['admin'] = count($modelUser->getRecordByUserType('admin'));
		$numusers['customer'] = count($modelUser->getRecordByUserType('customer'));
		$numusers['total'] = $numusers['driver'] + $numusers['superadmin'] + $numusers['admin'] + $numusers['customer'];

		$activeTabCustomer = 'active';
		$activeTabAdmin = '';

		switch($tab) {
			case \app\models\User::USERTYPE_CUSTOMER:
				$activeTabCustomer = 'active';
				$activeTabAdmin = '';
				break;
			case \app\models\User::USERTYPE_DRIVER:
				$activeTabCustomer = '';
				$activeTabAdmin = 'active';
				break;
		}

		if(\Yii::$app->request->post()) {
			$userObject = new \app\models\User;

			if(isset($_POST['CreateUserForm'])) {
				$post = $_POST['CreateUserForm'];

				$createUserFormObject->name = $post['name'];
				$createUserFormObject->email = $post['email'];
				$createUserFormObject->username = $post['username'];
				$createUserFormObject->password = $post['password'];

				$userType = \app\models\User::USERTYPE_DRIVER;
				if(isset($post['type'])) {
					$type = $post['type'];
				}
				$createUserFormObject->type = $userType;

				$createUserFormObject->userObject = $userObject;
				
				if($createUserFormObject->validate()) {
					$hash = $userObject->hash();
					$password = $userObject->encryptPassword($createUserFormObject->password, $hash, \Yii::$app->params['user']['securityKey']);				
					$dateCreated = $this->systemDate();

					$userId = $userObject->addRecord(
						$createUserFormObject->username,
						$createUserFormObject->name,
						$createUserFormObject->email,
						$password,
						$hash,
						$createUserFormObject->type,
						$dateCreated,
						'active'
					);

					$type = 'all';
					switch ($userType) {
						case 'customer':
							$type = 'customer';
							break;
						case 'driver':
							$type = 'driver';
							break;
						default:
							$type = 'all';
							break;
					}
					$this->redirect(\Yii::$app->urlManager->createUrl(['user/crud/view', 'id' => $userId]));
				}

				$activeTabCustomer = '';
				$activeTabAdmin = 'active';
			}

			if(isset($_POST['CreateCustomerForm'])) {
				$post = $_POST['CreateCustomerForm'];

				$createCustomerFormObject->companyName = $post['companyName'];
				$createCustomerFormObject->companyPhone = $post['companyPhone'];
				$createCustomerFormObject->postalCode = $post['postalCode'];
				$createCustomerFormObject->street = $post['street'];
				$createCustomerFormObject->buildingName = $post['buildingName'];
				$createCustomerFormObject->unitNumber = $post['unitNumber'];
				$createCustomerFormObject->contactPerson = $post['contactPerson'];
				$createCustomerFormObject->contactNumber = $post['contactNumber'];
				$createCustomerFormObject->email = $post['email'];
				$createCustomerFormObject->password = $post['password'];

				$createCustomerFormObject->userObject = $userObject;

				if($createCustomerFormObject->validate()) {
					$hash = $userObject->hash();
					$password = $userObject->encryptPassword($createCustomerFormObject->password, $hash, \Yii::$app->params['user']['securityKey']);
					$dateCreated = $this->systemDate();

					$userId = $userObject->addRecord(
						'',
						$createCustomerFormObject->companyName,
						$createCustomerFormObject->email,
						$password,
						$hash,
						'customer',
						$dateCreated,
						'active',
						$createCustomerFormObject->street,
						'',
						'',
						'',
						'',
						$createCustomerFormObject->postalCode,
						'no',
						'',
						$createCustomerFormObject->companyPhone,
						$createCustomerFormObject->buildingName,
						$createCustomerFormObject->unitNumber,
						$createCustomerFormObject->contactPerson,
						$createCustomerFormObject->contactNumber,
						'company'
					);

					$this->redirect(\Yii::$app->urlManager->createUrl(['user/crud/view', 'id' => $userId]));
				}

				$activeTabCustomer = 'active';
				$activeTabAdmin = '';
			}
		}

		$types = [];
		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_SUPER_ADMIN) {
			//$types['customer'] = 'Customer';
			$types['driver'] = 'Driver';
			$types['admin'] = 'Admin';
			$types['superadmin'] = 'Superadmin';
		} else {
			//$types['customer'] = 'Customer';
			$types['driver'] = 'Driver';
		}

		return $this->render('create', [
			'model' => $createUserFormObject,
			'numusers' => $numusers,
			'types' => $types,
			'createCustomerFormObject' => $createCustomerFormObject,
			'activeTabCustomer' => $activeTabCustomer,
			'activeTabAdmin' => $activeTabAdmin,
		]);
	}

	/**
	 * Updates an existing User model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_DRIVER || \Yii::$app->session->get('type') == \app\models\User::USERTYPE_CUSTOMER) {
			return $this->redirect(\Yii::$app->urlManager->createUrl('site/index'));
		}

		$this->setLayout('/backend');
		$this->setActiveNavigation('user-superadmin');
		$user = $this->findModel($id);
		$userobjectForm = NULL;
		$name = $user->name;

		$sessionId = \Yii::$app->session->get('id');
		if($sessionId == $user->id) {
			$this->redirect(\Yii::$app->urlManager->createUrl(['user/info/index']));
		}

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
		$userobjectForm->status = $user->status;
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
			$userobjectForm->password = $post['password'];
			$userobjectForm->status = $post['status'];
			$userobjectForm->userObject = $userObject;

			if($userobjectForm->validate()) {
				$dateUpdated = $this->systemDate();

				$password = '';
				if($userobjectForm->password !== '') {
					$password = $userObject->encryptPassword($userobjectForm->password, $user->hash, \Yii::$app->params['user']['securityKey']);
				}

				if($user->type == \app\models\User::USERTYPE_CUSTOMER) {
					$userObject->updateInfo(
						$user->id,
						$userobjectForm->username,
						$userobjectForm->companyName,
						$userobjectForm->email,
						$password,
						$userobjectForm->street,
						$userobjectForm->postalCode,
						$dateUpdated,
						$userobjectForm->companyPhone,
						$userobjectForm->buildingName,
						$userobjectForm->unitNumber,
						$userobjectForm->contactPerson,
						$userobjectForm->contactNumber,
						$userobjectForm->status
					);
				} else {
					$userObject->updateInfo(
						$user->id,
						$userobjectForm->username,
						$userobjectForm->name,
						$userobjectForm->email,
						$password,
						'',
						'',
						$dateUpdated,
						'',
						'',
						'',
						'',
						'',
						$userobjectForm->status
					);
				}

				return $this->redirect(['view', 'id' => $user->id]);
			}
		}

		return $this->render('update', [
			'model' => $userobjectForm,
			'name' => $name,
		]);
	}

	/**
	 * Deletes an existing User model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @param string $type
	 * @return mixed
	 */
	public function actionDelete($id, $type = 'all')
	{
		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_DRIVER || \Yii::$app->session->get('type') == \app\models\User::USERTYPE_CUSTOMER) {
			return $this->redirect(\Yii::$app->urlManager->createUrl('site/index'));
		}

		$user = $this->findModel($id);

		$type = $user->type;
		switch($user->type) {
			case \app\models\User::USERTYPE_SUPER_ADMIN:
			case \app\models\User::USERTYPE_ADMIN:
				$type = 'all';
				break;
			case \app\models\User::USERTYPE_DRIVER:
				$type = \app\models\User::USERTYPE_DRIVER;
				break;
		}

		$sessionId = \Yii::$app->session->get('id');
		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_SUPER_ADMIN && $user->id != $sessionId) {
			$user->updateStatus($id, 'delete');
		}
		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_ADMIN && ($user->type == \app\models\User::USERTYPE_DRIVER || $user->type == \app\models\User::USERTYPE_CUSTOMER)) {
			$user->updateStatus($id, 'delete');
		}

		return $this->redirect(\Yii::$app->urlManager->createUrl(['user/crud/list', 'type' => $type]));
	}

	/**
	 * Finds the User model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return User the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = User::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function actionDashboard()
	{
		$this->setLayout('/backend');
		$this->setActiveNavigation('dashboard');
		$modelDelivery = new delivery();
		$modelUser = new User();
		$date = date('Y-m-d', time());

		$recentDelivery = [];
		switch (\Yii::$app->session->get('type')) {
			case \app\models\User::USERTYPE_SUPER_ADMIN:
			case \app\models\User::USERTYPE_ADMIN:
				$recentDelivery = $modelDelivery->getDeliveryByDate($date);
				break;
			case \app\models\User::USERTYPE_CUSTOMER:
				$recentDelivery = $modelDelivery->getDeliveryByDateCustomer($date, 10, \Yii::$app->session->get('id'));
				break;
			case \app\models\User::USERTYPE_DRIVER:
				$recentDelivery = $modelDelivery->getDeliveryByDateDriver($date, 10, \Yii::$app->session->get('id'));
				break;
			default:
				$recentDelivery = $modelDelivery->getDeliveryByDate($date);
				break;
		}

		return $this->render('dashboard',[
			'recentDelivery' => $recentDelivery,
		]);
	}

	public function actionList($type = 'all')
	{
		if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_DRIVER || \Yii::$app->session->get('type') == \app\models\User::USERTYPE_CUSTOMER) {
			return $this->redirect(\Yii::$app->urlManager->createUrl('site/index'));
		}

		$this->setLayout('/backend');
		$this->setActiveNavigation('user-superadmin');

		$searchModel = new UserSearch();

		$render = 'index';
		switch ($type) {
			case 'customer':
				$render = 'customer';
				$dataProvider = $searchModel->searchCustomer(\Yii::$app->request->queryParams);
				break;
			case 'driver':
				$render = 'driver';
				$dataProvider = $searchModel->searchDriver(\Yii::$app->request->queryParams);
				break;
			default:
				$render = 'index';
				if(\Yii::$app->session->get('type') == \app\models\User::USERTYPE_SUPER_ADMIN) {
					$dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
				} else {
					$dataProvider = $searchModel->searchAdmin(\Yii::$app->request->queryParams);
				}
				break;
		}

		return $this->render('//../modules/user/views/list/' . $render, [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}
}