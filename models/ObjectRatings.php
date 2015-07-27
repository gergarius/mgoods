<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "object_ratings".
 *
 * @property string  $id
 * @property string  $object_id
 * @property string  $rating
 * @property string  $parent_id
 * @property string  $user_id
 * @property string  $recall
 * @property string  $date
 * @property integer $status
 */
class ObjectRatings extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'object_ratings';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			//[['object_id', 'rating', 'parent_id', 'user_id', 'recall'], 'required'],
			[['object_id', 'rating',], 'required'],
			[['object_id', 'rating', 'parent_id', 'user_id', 'status'], 'integer'],
			[['recall'], 'string'],
			[['date'], 'safe']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id'        => Yii::t('app', 'ID'),
			'object_id' => Yii::t('app', 'Object ID'),
			'rating'    => Yii::t('app', 'Rating'),
			'parent_id' => Yii::t('app', 'Parent ID'),
			'user_id'   => Yii::t('app', 'User ID'),
			'recall'    => Yii::t('app', 'Recall'),
			'date'      => Yii::t('app', 'Date'),
			'status'    => Yii::t('app', 'Status'),
		];
	}


	public function getRatingByObjectID($object_id) {

		$rating = $this->find()->select(['SUM(rating)/COUNT(*) AS rating_mean, rating, parent_id, user_id, recall, date, status'])->where('object_id = :object_id')->params([':object_id' => $object_id,])->one();

		return $rating;
	}

}
