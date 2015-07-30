<?php

namespace app\modules\ratings\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\ratings\models\Ratings;

/**
 * RatingsSearch represents the model behind the search form about `app\modules\ratings\models\Ratings`.
 */
class RatingsSearch extends Ratings {
	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['id', 'created_at', 'updated_at', 'updated_by_user_id', 'object_id', 'shop_id', 'good_id', 'rating', 'status'], 'integer'],
			[['name', 'pluses', 'minuses', 'email', 'comment'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function scenarios() {
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
	public function search($params) {
		$query = Ratings::find();

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
			'id'                 => $this->id,
			'created_at'         => $this->created_at,
			'updated_at'         => $this->updated_at,
			'updated_by_user_id' => $this->updated_by_user_id,
			'object_id'          => $this->object_id,
			'shop_id'            => $this->shop_id,
			'good_id'            => $this->good_id,
			'rating'             => $this->rating,
			'status'             => $this->status,
		]);

		$query->andFilterWhere(['like', 'name', $this->name])->andFilterWhere(['like', 'pluses', $this->pluses])->andFilterWhere([
				'like',
				'minuses',
				$this->minuses
			])->andFilterWhere(['like', 'email', $this->email])->andFilterWhere(['like', 'comment', $this->comment]);

		return $dataProvider;
	}
}
