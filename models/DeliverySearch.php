<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Delivery;
use app\models\User;

/**
 * DeliverySearch represents the model behind the search form about `app\models\Delivery`.
 */
class DeliverySearch extends Delivery
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id', 'delivery_book_id', 'customer_id', 'driver_id', 'vehicle_id'], 'integer'],
			[['receiver_name', 'tracking_id', 'date_delivery', 'delivery_time', 'tel_no', 'image_signature', 'address1', 'address2', 'city', 'province', 'country_name', 'zip_code', 'package_type', 'status', 'sender_company'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params)
	{
		$modelUser = new User;
		$userType = \Yii::$app->session->get('type');
		$userID = \Yii::$app->session->get('id');
		
		if ($userType == $modelUser::USERTYPE_SUPER_ADMIN || $userType == $modelUser::USERTYPE_ADMIN){
			$query = Delivery::find()->orderBy(['delivery_ordering' => SORT_ASC]);

			//$query = Delivery::find()
			//->joinWith('user')  
			//->where(['delivery.driver_id' => 'user.id']);
			//->leftJoin('user', '`delivery`.`driver_id` = `user`.`id`');
			//->all();
		}

		if ($userType == $modelUser::USERTYPE_CUSTOMER){
			$query = Delivery::find()
			->where(['customer_id' => $userID]);
		}
	
		if ($userType == $modelUser::USERTYPE_DRIVER){
			$query = Delivery::find()
			->where(['driver_id' => $userID]);
		}

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		$query->andFilterWhere([
            'id' => $this->id,
            'date_delivery' => $this->date_delivery,
            'cartoon_size' => $this->cartoon_size,
            'cartoon_weight' => $this->cartoon_weight,
            'no_cartoons' => $this->no_cartoons,
            'customer_id' => $this->customer_id,
            'driver_id' => $this->driver_id,
            'vehicle_id' => $this->vehicle_id,
        ]);

        $query->andFilterWhere(['like', 'sender_name', $this->sender_name])
            ->andFilterWhere(['like', 'sender_company', $this->sender_company])
            ->andFilterWhere(['like', 'sender_contact', $this->sender_contact])
            ->andFilterWhere(['like', 'sender_pickup_address', $this->sender_pickup_address])
            ->andFilterWhere(['like', 'receiver_name', $this->receiver_name])
            ->andFilterWhere(['like', 'receiver_company', $this->receiver_company])
            ->andFilterWhere(['like', 'tracking_id', $this->tracking_id])
            ->andFilterWhere(['like', 'delivery_book_id', $this->delivery_book_id])
            ->andFilterWhere(['like', 'delivery_time', $this->delivery_time])
            ->andFilterWhere(['like', 'receiver_contact', $this->receiver_contact])
            ->andFilterWhere(['like', 'postal_code', $this->postal_code])
            ->andFilterWhere(['like', 'blk_street_name', $this->blk_street_name])
            ->andFilterWhere(['like', 'bldg_name', $this->bldg_name])
            ->andFilterWhere(['like', 'unit_no', $this->unit_no])
            ->andFilterWhere(['like', 'type_products', $this->type_products])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no])
            ->andFilterWhere(['like', 'image_signature', $this->image_signature])
            ->andFilterWhere(['like', 'address1', $this->address1])
            ->andFilterWhere(['like', 'address2', $this->address2])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'country_name', $this->country_name])
            ->andFilterWhere(['like', 'zip_code', $this->zip_code])
            ->andFilterWhere(['like', 'package_type', $this->package_type])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'document', $this->document]);

		return $dataProvider;
	}
}
