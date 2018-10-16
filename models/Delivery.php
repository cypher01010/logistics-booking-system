<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "delivery".
 *
 * @property integer $id
 * @property string $sender_name
 * @property string $sender_company
 * @property string $sender_contact
 * @property string $sender_pickup_address
 * @property string $receiver_name
 * @property string $receiver_company
 * @property string $tracking_id
 * @property string $delivery_book_id
 * @property string $date_delivery
 * @property string $delivery_time
 * @property string $receiver_contact
 * @property string $postal_code
 * @property string $blk_street_name
 * @property string $bldg_name
 * @property string $unit_no
 * @property string $type_products
 * @property string $tel_no
 * @property double $cartoon_size
 * @property double $cartoon_weight
 * @property integer $no_cartoons
 * @property string $image_signature
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $province
 * @property string $country_name
 * @property string $zip_code
 * @property integer $customer_id
 * @property integer $driver_id
 * @property integer $vehicle_id
 * @property string $package_type
 * @property string $status
 * @property string $document
 * @property integer $delivery_ordering
 * @property string $sender_postal_code
 * @property string $sender_blk_street_name
 * @property string $sender_bldg_name
 * @property string $sender_unit_no
 * @property string $latitude
 * @property string $longitude
 * @property string $remarks
 * @property string $date_created
 */
class Delivery extends \yii\db\ActiveRecord
{
	public $customer;
	public $signaturePad;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'delivery';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['date_delivery'], 'safe'],
			[['cartoon_size', 'cartoon_weight'], 'number'],
			[['no_cartoons', 'customer_id', 'driver_id', 'vehicle_id', 'delivery_ordering'], 'integer'],
			[['package_type', 'status'], 'string'],
			[['sender_name', 'sender_company', 'receiver_name', 'receiver_company', 'blk_street_name', 'bldg_name', 'address1', 'address2', 'city', 'document', 'sender_blk_street_name', 'sender_bldg_name'], 'string', 'max' => 128],
			[['sender_contact', 'delivery_time', 'receiver_contact', 'postal_code', 'unit_no', 'type_products', 'tel_no', 'zip_code', 'sender_postal_code', 'sender_unit_no', 'latitude', 'longitude', 'remarks', 'date_created'], 'string', 'max' => 32],
			[['sender_pickup_address', 'image_signature'], 'string', 'max' => 512],
			[['tracking_id', 'delivery_book_id', 'province', 'country_name'], 'string', 'max' => 64]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'sender_name' => 'Sender\'s Name',
			'sender_company' => 'Sender\'s Company',
			'sender_contact' => 'Contact No.',
			'sender_pickup_address' => 'Sender Pickup Address',
			'receiver_name' => 'Receiver Name',
			'receiver_company' => 'Receiver Company',
			'tracking_id' => 'Tracking ID',
			'delivery_book_id' => 'Booking ID',
			'date_delivery' => 'Delivery Date',
			'delivery_time' => 'Delivery Time',
			'receiver_contact' => 'Contact No.',
			'postal_code' => 'Postal Code',
			'blk_street_name' => 'Blk and Street Name',
			'bldg_name' => 'Building Name',
			'unit_no' => 'Unit Number',
            
            'sender_postal_code' => 'Postal Code',
			'sender_blk_street_name' => 'Blk and Street Name',
			'sender_bldg_name' => 'Building Name',
			'sender_unit_no' => 'Unit Number',
			
            'type_products' => 'Type of product(s)',
			'tel_no' => 'Tel No',
			'cartoon_size' => 'Carton size (LxWxH)',
			'cartoon_weight' => 'Carton weight (in kg)',
			'no_cartoons' => 'No. of carton(s)',
			'image_signature' => 'Image Signature',
			'address1' => 'Address1',
			'address2' => 'Address2',
			'city' => 'City',
			'province' => 'Province',
			'country_name' => 'Country Name',
			'zip_code' => 'Zip Code',
			'customer_id' => 'Customer ID',
			'driver_id' => 'Driver ID',
			'vehicle_id' => 'Vehicle ID',
			'package_type' => 'Package Type',
			'status' => 'Status',
			'document' => 'Document',
			'delivery_ordering' => 'Delivery Ordering',
			'remarks' => 'Remarks',
			'date_created' => 'Date Created',
		];
	}

	public function getRecentDeliveries($limit)
	{
		$sql =
		'
			SELECT
				`delivery`.*
			FROM
				`delivery`
			ORDER BY date_delivery desc
			LIMIT 
				' . $limit . ' 
			
		';

		$response = self::findBySql($sql)->asArray()->all();
		if(isset($response) && $response != null) {
			return $response;
		}

		return [];
	}
	
	public function getRecentDeliveriesCustomer($limit, $customerid)
	{
		$sql =
		'
			SELECT
				`delivery`.*
			FROM
				`delivery`
			WHERE
			customer_id = 
				'. $customerid .'
			ORDER BY date_delivery desc
			LIMIT 
				' . $limit . ' 	
		';

		$response = self::findBySql($sql)->asArray()->all();
		if(isset($response) && $response != null) {
			return $response;
		}

		return [];
	}
    
    public function getDailyDeliveries($day)
	{
		$sql =
		'
			SELECT
				`delivery`.*
			FROM
				`delivery`
			WHERE
                date_delivery =
                \''. $day .'\'
		';

		$response = self::findBySql($sql)->asArray()->all();
		if(isset($response) && $response != null) {
			return $response;
		}

		return [];
	}
	
	public function getRecentDeliveriesDriver($limit, $driverid)
	{
		$sql =
		'
			SELECT
				`delivery`.*
			FROM
				`delivery`
			WHERE
			driver_id = 
				'. $driverid .'
			ORDER BY date_delivery desc
			LIMIT 
				' . $limit . ' 			
		';

		$response = self::findBySql($sql)->asArray()->all();
		if(isset($response) && $response != null) {
			return $response;
		}

		return [];
	}
	
	public function getDeliveryPerMonth($start, $end)
	{
		$sql =
		'
			SELECT
				`delivery`.`date_delivery`,
				COUNT(`delivery`.`date_delivery`) AS delivery_today
			FROM
				`delivery`
			WHERE
				(`delivery`.`date_delivery` BETWEEN \'' . $start . '\' AND \'' . $end . '\')
			GROUP BY `delivery`.`date_delivery`
		';

		$response = self::findBySql($sql)->asArray()->all();
		if(isset($response) && $response != null) {
			return $response;
		}

		return [];
	}

	public function statusList()
	{
		return [
			'requested' => 'Requested',
			'allocated' => 'Allocated',
			'delivered' => 'Delivered',
			'failed' => 'Failed - Customer not in',
			'cancelled' => 'Cancelled',
		];
	}

	public function adminStatusListCreate()
	{
		return [
			'requested' => 'Requested',
			'allocated' => 'Allocated',
			//'delivered' => 'Delivered',
			//'failed' => 'Failed - Customer not in',
			//'cancelled' => 'Cancelled',
		];
	}

	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'driver_id']);
	}

	public function getDeliveryByDate($date, $limit = 10)
	{
		$sql =
		'
			SELECT 
				`delivery`.*
			FROM
				`delivery`
			WHERE
				`delivery`.`date_delivery` = \'' .  $date . '\'
			LIMIT ' . $limit . '
		';

		$response = self::findBySql($sql)->asArray()->all();
		if(isset($response) && $response != null) {
			return $response;
		}

		return [];
	}

	public function getDeliveryByDateCustomer($date, $limit, $customerid)
	{
		$sql =
		'
			SELECT
				`delivery`.*
			FROM
				`delivery`
			WHERE
				`delivery`.`customer_id` = ' . $customerid . ' AND `delivery`.`date_delivery` = \'' .  $date . '\'
			ORDER BY `delivery`.`date_delivery` desc
			LIMIT ' . $limit . '
		';

		$response = self::findBySql($sql)->asArray()->all();
		if(isset($response) && $response != null) {
			return $response;
		}

		return [];
	}

	public function getDeliveryByDateDriver($date, $limit, $driverid)
	{
		$sql =
		'
			SELECT
				`delivery`.*
			FROM
				`delivery`
			WHERE
				`delivery`.`driver_id` = ' . $driverid . ' AND `delivery`.`date_delivery` = \'' .  $date . '\'
			ORDER BY `delivery`.`date_delivery` desc
			LIMIT ' . $limit . '
		';

		$response = self::findBySql($sql)->asArray()->all();
		if(isset($response) && $response != null) {
			return $response;
		}

		return [];
	}

	public function getDeliveryPerMonthCustomer($customerid, $start, $end)
	{
		$sql =
		'
			SELECT
				`delivery`.`date_delivery`,
				COUNT(`delivery`.`date_delivery`) AS delivery_today
			FROM
				`delivery`
			WHERE
				(`delivery`.`date_delivery` BETWEEN \'' . $start . '\' AND \'' . $end . '\') AND `delivery`.`customer_id` = '. $customerid .'
			GROUP BY `delivery`.`date_delivery`
		';

		$response = self::findBySql($sql)->asArray()->all();
		if(isset($response) && $response != null) {
			return $response;
		}

		return [];
	}

	public function getDeliveryPerMonthDriver($driverid, $start, $end)
	{
		$sql =
		'
			SELECT
				`delivery`.`date_delivery`,
				COUNT(`delivery`.`date_delivery`) AS delivery_today
			FROM
				`delivery`
			WHERE
				(`delivery`.`date_delivery` BETWEEN \'' . $start . '\' AND \'' . $end . '\') AND `delivery`.`driver_id` = '. $driverid .'
			GROUP BY `delivery`.`date_delivery`
		';

		$response = self::findBySql($sql)->asArray()->all();
		if(isset($response) && $response != null) {
			return $response;
		}

		return [];
	}

	public function addRecordByArray($params)
	{
		foreach ($params as $key => $value) {
			if($value != '') {
				$this->$key = $value;
			}
		}

		$this->insert();
		return $this->id;
	}

	public function updateRecordByArray($id, $params)
	{
		$record = $this->findOne($id);

		foreach ($params as $key => $value) {
			$record->$key = $value;
		}

		$record->save();
	}

	public function deliveryTimeList()
	{
		return [
			'09:30 - 13:00' => '09:30 - 13:00',
			'13:30 - 17:30' => '13:30 - 17:30',
			'18:00 - 20:30' => '18:00 - 20:30',
		];
	}

	public function getDriverDeliveryRecords($condition)
	{
		return $this->find()
					->where($condition)
					->orderBy(['delivery_ordering' => SORT_ASC])
					->asArray()
					->all();
	}

	public function updateDeliverySorting($sql)
	{
		$connection = \Yii::$app->db;
		$command = $connection->createCommand($sql);
		$command->execute();
		return true;
	}

	public function createdToday($day)
	{
		$sql =
		'
			SELECT
				`delivery`.*
			FROM
				`delivery`
			WHERE
				`delivery`.`date_created` = \''. $day .'\'
		';

		$response = self::findBySql($sql)->asArray()->all();
		if(isset($response) && $response != null) {
			return $response;
		}

		return [];
	}
}