<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "delivery_book".
 *
 * @property integer $id
 * @property integer $costumer_id
 * @property string $date_book
 * @property string $status
 */
class DeliveryBook extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'delivery_book';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['costumer_id'], 'required'],
			[['costumer_id'], 'integer'],
			[['date_book'], 'safe'],
			[['status'], 'string']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'costumer_id' => 'Costumer ID',
			'date_book' => 'Date Book',
			'status' => 'Status',
		];
	}
}
