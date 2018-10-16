<?php
namespace app\modules\delivery\forms;

class CreateDeliveryForm extends \yii\base\Model
{
	public $customer_id;

	public $sender_name;
	public $sender_company;
	public $sender_contact;
	public $sender_pickup_address;

	public $receiver_name;
	public $receiver_company;
	public $tracking_id;
	public $delivery_book_id;
	public $date_delivery;
	public $delivery_time;
    public $remarks;
	public $receiver_contact;
	public $postal_code;
	public $blk_street_name;
	public $bldg_name;
	public $unit_no;
	public $type_products;
	public $cartoon_size;
	public $cartoon_weight;
	public $no_cartoons;

	public $document;
	public $driver_id;
	public $status;


	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			['sender_name', 'required', 'message' => 'Required'],
			//['sender_company', 'required', 'message' => 'Required'],
			//['sender_contact', 'required', 'message' => 'Required'],
			['sender_pickup_address', 'required', 'message' => 'Required'],

			['receiver_name', 'required', 'message' => 'Required'],
			//['receiver_company', 'required', 'message' => 'Required'],
			['tracking_id', 'required', 'message' => 'Required'],
			['delivery_book_id', 'required', 'message' => 'Required'],
			['date_delivery', 'required', 'message' => 'Required'],
			['delivery_time', 'required', 'message' => 'Required'],
			//['receiver_contact', 'required', 'message' => 'Required'],
			//['postal_code', 'required', 'message' => 'Required'],
			//['blk_street_name', 'required', 'message' => 'Required'],
			//['bldg_name', 'required', 'message' => 'Required'],
			//['unit_no', 'required', 'message' => 'Required'],
			//['type_products', 'required', 'message' => 'Required'],
			//['cartoon_size', 'required', 'message' => 'Required'],
			//['cartoon_weight', 'required', 'message' => 'Required'],
			//['no_cartoons', 'required', 'message' => 'Required'],
		];
	}
}