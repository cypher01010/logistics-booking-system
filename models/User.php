<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $name
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $province
 * @property string $country_name
 * @property string $zip_code
 * @property string $email
 * @property string $password
 * @property string $hash
 * @property string $password_updated
 * @property string $date_created
 * @property string $date_updated
 * @property string $status
 * @property string $type
 * @property string $company_phone
 * @property string $building_name
 * @property string $unit_number
 * @property string $contact_person
 * @property string $contact_number
 * @property string $customer_type
 */
class User extends \yii\db\ActiveRecord
{
	const USERTYPE_SUPER_ADMIN = 'superadmin';
	const USERTYPE_ADMIN = 'admin';
	const USERTYPE_CUSTOMER = 'customer';
	const USERTYPE_DRIVER = 'driver';

	const STATUS_ACTIVE = 'active';
	const STATUS_INACTIVE = 'inactive';
	const STATUS_DELETE = 'delete';
	const STATUS_SPAM = 'spam';

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'user';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['password_updated', 'status', 'type', 'customer_type'], 'string'],
			[['date_created', 'date_updated'], 'safe'],
			[['username', 'zip_code', 'hash', 'unit_number'], 'string', 'max' => 32],
			[['name', 'province', 'country_name', 'email', 'company_phone'], 'string', 'max' => 64],
			[['address1', 'address2', 'city', 'password', 'building_name', 'contact_person', 'contact_number'], 'string', 'max' => 128]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'username' => 'Username',
			'name' => 'Name',
			'address1' => 'Address1',
			'address2' => 'Address2',
			'city' => 'City',
			'province' => 'Province',
			'country_name' => 'Country Name',
			'zip_code' => 'Zip Code',
			'email' => 'Email',
			'password' => 'Password',
			'hash' => 'Hash',
			'password_updated' => 'Password Updated',
			'date_created' => 'Date Created',
			'date_updated' => 'Date Updated',
			'status' => 'Status',
			'type' => 'Type',
			'company_phone' => 'Company Phone',
			'building_name' => 'Building Name',
			'unit_number' => 'Unit Number',
			'contact_person' => 'Contact Person',
			'contact_number' => 'Contact Number',
			'customer_type' => 'Customer Type',
		];
	}

	/**
	 * checking the password
	 *
	 * @param $password
	 * @param $hash
	 * @param $securityKey
	 * @return bool
	 */
	public function validatePassword($password, $hash, $securityKey)
	{
		return $this->encryptPassword($password, $hash, $securityKey) === $this->password;
	}

	/**
	 * Generate the users hash
	 *
	 * @return hash
	 */
	public function hash()
	{
		return  substr(sha1(time()), 12, 32);
	}

	/**
	 * Add new record/register
	 *
	 * @return user id
	 */
	public function addRecord($username = '', $name, $email, $password, $hash, $type, $dateCreated, $status, $address1 = '', $address2 = '', $city = '', $province = '', $countryName = '', $zipCode = '', $passwordUpdated = 'no', $dateUpdated = '', $companyPhone = '', $buildingName = '', $unitNumber = '', $contactPerson = '', $contactNumber = '', $customerType = 'person')
	{
		if($username !== '') {
			$this->username = $username;
		}

		$this->name = $name;
		$this->email = $email;
		$this->password = $password;
		$this->hash = $hash;
		$this->type = $type;
		$this->date_created = $dateCreated;
		$this->status = $status;

		if($address1 !== '') {
			$this->address1 = $address1;
		}

		if($address2 !== '') {
			$this->address2 = $address2;
		}

		if($city !== '') {
			$this->city = $city;
		}

		if($province !== '') {
			$this->province = $province;
		}

		if($countryName !== '') {
			$this->country_name = $countryName;
		}

		if($zipCode !== '') {
			$this->zip_code = $zipCode;
		}

		if($passwordUpdated !== '') {
			$this->password_updated = $passwordUpdated;
		}

		if($dateUpdated !== '') {
			$this->date_updated = $dateUpdated;
		}

		if($companyPhone !== '') {
			$this->company_phone = $companyPhone;
		}
		if($buildingName !== '') {
			$this->building_name = $buildingName;
		}
		if($unitNumber !== '') {
			$this->unit_number = $unitNumber;
		}
		if($contactPerson !== '') {
			$this->contact_person = $contactPerson;
		}
		if($contactNumber !== '') {
			$this->contact_number = $contactNumber;
		}
		if($customerType !== '') {
			$this->customer_type = $customerType;
		}

		$this->insert();
		return $this->id;
	}

	/**
	 * encrypt password
	 *
	 * @param $password
	 * @param $hash
	 * @param $securityKey
	 * @return string
	 */
	public function encryptPassword($password, $hash, $securityKey)
	{
		return sha1($password . $hash . $securityKey);
	}

	/**
	 * Get the users info by username
	 *
	 * @param $username
	 * @return users info|object|NULL
	 */
	public function getRecordByUsername($username)
	{
		$sql =
		'
			SELECT
				user.*
			FROM
				user
			WHERE
				user.username =  \'' . $username . '\' AND `user`.`status` = \'active\'
		';

		$response = self::findBySql($sql)->one();
		if(isset($response) && $response != null) {
			return $response;
		}

		return NULL;
	}

	/**
	 * Get the users info by username
	 *
	 * @param $username
	 * @return array users info
	 */
	public function getRecordByUsernameArray($username)
	{
		$sql =
		'
			SELECT
				`user`.*
			FROM
				`user`
			WHERE
				`user`.`username` =  \'' . $username . '\' AND `user`.`status` = \'active\'
		';

		$response = self::findBySql($sql)->asArray()->one();
		if(isset($response) && $response != null) {
			return $response;
		}

		return [];
	}

	/**
	 * Get the users info by email
	 *
	 * @param $username
	 * @return array users info
	 */
	public function getRecordByEmailArray($email)
	{
		$sql =
		'
			SELECT
				`user`.*
			FROM
				`user`
			WHERE
				`user`.`email` =  \'' . $email . '\' AND `user`.`status` = \'active\'
		';

		$response = self::findBySql($sql)->asArray()->one();
		if(isset($response) && $response != null) {
			return $response;
		}

		return [];
	}
    
    /**
	 * Get the users info by id
	 *
	 * @param $username
	 * @return array users info
	 */
	public function getRecordByIdArray($id)
	{
		$sql =
		'
			SELECT
				`user`.*
			FROM
				`user`
			WHERE
				`user`.`id` =  \'' . $id . '\' AND `user`.`status` = \'active\'
		';

		$response = self::findBySql($sql)->asArray()->one();
		if(isset($response) && $response != null) {
			return $response;
		}

		return [];
	}
    
    public function getRecordByUserType($usertype)
	{
		$sql =
		'
			SELECT
				`user`.*
			FROM
				`user`
			WHERE
				`user`.`type` =  \'' . $usertype . '\' AND `user`.`status` = \'active\'
		';

		$response = self::findBySql($sql)->asArray()->all();
		if(isset($response) && $response != null) {
			return $response;
		}

		return [];
	}

	/**
	 * Update user info
	 */
	public function updateRecord($id, $name, $username, $email)
	{
		$record = $this->findOne($id);
		$record->name = $name;
		$record->username = $username;
		$record->email = $email;
		$record->save();
	}

	/**
	 * Update user info
	 */
	public function updatePassword($id, $password)
	{
		$record = $this->findOne($id);
		$record->password = $password;
		$record->save();
	}

	/**
	 * Update user info
	 */
	public function updateStatus($id, $status)
	{
		$record = $this->findOne($id);
		$record->status = $status;
		$record->save();
	}

	/**
	 * Get the users info by email
	 *
	 * @param $email
	 * @return users info|object|NULL
	 */
	public function getRecordByEmail($email)
	{
		$response = self::find()->where(['email' => $email])->asArray()->one();

		if(isset($response) && $response != null) {
			return $response;
		}

		return array();
	}

	/**
	 * Get the users info by email
	 *
	 * @param $email
	 * @return users info|object|NULL
	 */
	public function getRecordByEmailObject($email)
	{
		$response = self::find()->where(['email' => $email])->one();

		if(isset($response) && $response != null) {
			return $response;
		}

		return NULL;
	}

	/**
	 * Find the users record by key
	 * @param  $key
	 * @return object|NULL
	 */
	public function findByRecoveryKey($key)
	{
		$response = self::find()->where(['recovery_key' => $key])->asArray()->one();

		if(isset($response) && $response != null) {
			return $response;
		}

		return NULL;
	}

	/**
	 * Update password from recovery
	 *
	 * @param $id
	 * @param $hash
	 * @param $password
	 * 
	 */
	public function updateRecoveredPassword($id, $hash, $password){
		$user = $this->findOne($id);
		$user->hash = $hash;
		$user->password = $password;
		//destroy the recovery key
		$user->recovery_key = '';
		$user->save();
	}
	/**
	 * Generate random characters
	 * @param  $min
	 * @param  $max
	 * @param  [$charset='']
	 * @return random characters
	 */
	public function randomCharacters($min, $max, $charset='')
	{
		if(empty($charset)) {
			$charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		}

		$char = '';
		$end = mt_rand ($min, $max);
		for ($start=0; $start < $end; $start++) $char .= $charset[(mt_rand(0,(strlen($charset)-1)))];
		return $char;
	}

	/**
	 * Update User Recovery Key
	 *
	 * @param $id
	 * @param $recoverykey
	 * 
	 */
	public function updateRecoveryKey($id, $recoverykey)
	{
		$user = $this->findOne($id);
		$user->recovery_key = $recoverykey;
		$user->save();
	}

	/**
	 * Update the users information
	 *
	 * @return user id
	 */
	public function updateInfo($id, $username = '', $name, $email, $password = '', $address1 = '', $zipCode = '', $dateUpdated = '', $companyPhone = '', $buildingName = '', $unitNumber = '', $contactPerson = '', $contactNumber = '', $status = 'active')
	{
		$record = $this->findOne($id);
		

		if($username !== '') {
			$record->username = $username;
		}

		$record->name = $name;
		$record->email = $email;

		if($password !== '') {
			$record->password = $password;
			$record->password_updated = 'yes';
		}

		if($address1 !== '') {
			$record->address1 = $address1;
		}

		if($zipCode !== '') {
			$record->zip_code = $zipCode;
		}

		if($dateUpdated !== '') {
			$record->date_updated = $dateUpdated;
		}

		if($companyPhone !== '') {
			$record->company_phone = $companyPhone;
		}

		if($buildingName !== '') {
			$record->building_name = $buildingName;
		}

		if($unitNumber !== '') {
			$record->unit_number = $unitNumber;
		}

		if($contactPerson !== '') {
			$record->contact_person = $contactPerson;
		}

		if($contactNumber !== '') {
			$record->contact_number = $contactNumber;
		}

		$record->status = $status;

		$record->save();
	}
}