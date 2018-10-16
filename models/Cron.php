<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "cron".
 *
 * @property string $id
 * @property string $time
 */
class Cron extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'cron';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['time'], 'required'],
			[['time'], 'string', 'max' => 32]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'time' => 'Time',
		];
	}

	public function addRecord($params)
	{
		foreach ($params as $key => $value) {
			if($value != '') {
				$this->$key = $value;
			}
		}

		$this->insert();
		return $this->id;
	}

	public function getRecord($condition)
	{
		return $this->find()->where($condition)->asArray()->one();
	}
}