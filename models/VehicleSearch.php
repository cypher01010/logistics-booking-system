<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vehicle;

/**
 * VehicleSearch represents the model behind the search form about `app\models\Vehicle`.
 */
class VehicleSearch extends Vehicle
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'speed_limit', 'stationary_limit', 'grab'], 'integer'],
            [['code', 'vehicle_no'], 'safe'],
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
        $query = Vehicle::find();

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
            'speed_limit' => $this->speed_limit,
            'stationary_limit' => $this->stationary_limit,
            'grab' => $this->grab,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'vehicle_no', $this->vehicle_no]);

        return $dataProvider;
    }
}
