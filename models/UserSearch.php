<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id'], 'integer'],
			[['username', 'name', 'address1', 'address2', 'city', 'province', 'country_name', 'zip_code', 'email', 'password', 'hash', 'password_updated', 'date_created', 'date_updated', 'status', 'type'], 'safe'],
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
		$query = User::find()->where(array('status' => \app\models\User::STATUS_ACTIVE));

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
			'date_created' => $this->date_created,
			'date_updated' => $this->date_updated,
		]);

		$query->andFilterWhere(['like', 'username', $this->username])
			->andFilterWhere(['like', 'name', $this->name])
			->andFilterWhere(['like', 'address1', $this->address1])
			->andFilterWhere(['like', 'address2', $this->address2])
			->andFilterWhere(['like', 'city', $this->city])
			->andFilterWhere(['like', 'province', $this->province])
			->andFilterWhere(['like', 'country_name', $this->country_name])
			->andFilterWhere(['like', 'zip_code', $this->zip_code])
			->andFilterWhere(['like', 'email', $this->email])
			->andFilterWhere(['like', 'password', $this->password])
			->andFilterWhere(['like', 'hash', $this->hash])
			->andFilterWhere(['like', 'password_updated', $this->password_updated])
			->andFilterWhere(['like', 'status', $this->status])
			->andFilterWhere(['like', 'type', $this->type]);

		return $dataProvider;
	}

	public function searchAdmin($params)
	{
		$query = User::find()->where(array('type' => \app\models\User::USERTYPE_CUSTOMER, 'status' => \app\models\User::STATUS_ACTIVE))->orWhere(array('type' => \app\models\User::USERTYPE_DRIVER, 'status' => \app\models\User::STATUS_ACTIVE));

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
			'date_created' => $this->date_created,
			'date_updated' => $this->date_updated,
		]);

		$query->andFilterWhere(['like', 'username', $this->username])
			->andFilterWhere(['like', 'name', $this->name])
			->andFilterWhere(['like', 'address1', $this->address1])
			->andFilterWhere(['like', 'address2', $this->address2])
			->andFilterWhere(['like', 'city', $this->city])
			->andFilterWhere(['like', 'province', $this->province])
			->andFilterWhere(['like', 'country_name', $this->country_name])
			->andFilterWhere(['like', 'zip_code', $this->zip_code])
			->andFilterWhere(['like', 'email', $this->email])
			->andFilterWhere(['like', 'password', $this->password])
			->andFilterWhere(['like', 'hash', $this->hash])
			->andFilterWhere(['like', 'password_updated', $this->password_updated])
			->andFilterWhere(['like', 'status', $this->status])
			->andFilterWhere(['like', 'type', $this->type]);

		return $dataProvider;
	}

	public function searchCustomer($params)
	{
		$query = User::find()->where(array('type' => \app\models\User::USERTYPE_CUSTOMER, 'status' => \app\models\User::STATUS_ACTIVE));

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
			'date_created' => $this->date_created,
			'date_updated' => $this->date_updated,
		]);

		$query->andFilterWhere(['like', 'username', $this->username])
			->andFilterWhere(['like', 'name', $this->name])
			->andFilterWhere(['like', 'address1', $this->address1])
			->andFilterWhere(['like', 'address2', $this->address2])
			->andFilterWhere(['like', 'city', $this->city])
			->andFilterWhere(['like', 'province', $this->province])
			->andFilterWhere(['like', 'country_name', $this->country_name])
			->andFilterWhere(['like', 'zip_code', $this->zip_code])
			->andFilterWhere(['like', 'email', $this->email])
			->andFilterWhere(['like', 'password', $this->password])
			->andFilterWhere(['like', 'hash', $this->hash])
			->andFilterWhere(['like', 'password_updated', $this->password_updated])
			->andFilterWhere(['like', 'status', $this->status])
			->andFilterWhere(['like', 'type', $this->type]);

		return $dataProvider;
	}

	public function searchDriver($params)
	{
		$query = User::find()->where(array('type' => \app\models\User::USERTYPE_DRIVER, 'status' => \app\models\User::STATUS_ACTIVE));

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
			'date_created' => $this->date_created,
			'date_updated' => $this->date_updated,
		]);

		$query->andFilterWhere(['like', 'username', $this->username])
			->andFilterWhere(['like', 'name', $this->name])
			->andFilterWhere(['like', 'address1', $this->address1])
			->andFilterWhere(['like', 'address2', $this->address2])
			->andFilterWhere(['like', 'city', $this->city])
			->andFilterWhere(['like', 'province', $this->province])
			->andFilterWhere(['like', 'country_name', $this->country_name])
			->andFilterWhere(['like', 'zip_code', $this->zip_code])
			->andFilterWhere(['like', 'email', $this->email])
			->andFilterWhere(['like', 'password', $this->password])
			->andFilterWhere(['like', 'hash', $this->hash])
			->andFilterWhere(['like', 'password_updated', $this->password_updated])
			->andFilterWhere(['like', 'status', $this->status])
			->andFilterWhere(['like', 'type', $this->type]);

		return $dataProvider;
	}
}