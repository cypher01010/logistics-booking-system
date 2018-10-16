<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vehicle".
 *
 * @property integer $id
 * @property string $code
 * @property string $vehicle_no
 * @property integer $speed_limit
 * @property integer $stationary_limit
 * @property integer $grab
 */
class Vehicle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vehicle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['speed_limit', 'stationary_limit', 'grab'], 'integer'],
            [['code', 'vehicle_no'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'vehicle_no' => 'Vehicle No',
            'speed_limit' => 'Speed Limit',
            'stationary_limit' => 'Stationary Limit',
            'grab' => 'Grab',
        ];
    }
}
