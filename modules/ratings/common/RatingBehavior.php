<?php
namespace app\modules\ratings\common;

use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class RatingBehavior extends Behavior {

	public $attribute = 'updated_by_user_id';

	public function events() {
		return [
			ActiveRecord::EVENT_BEFORE_VALIDATE => 'getUpdatedUserId'
		];
	}

	public function getUpdatedUserId($event) {
		$userID = Yii::$app->user->getId();
		$this->owner->{$this->attribute} = ($userID) ? $userID : 0;
	}

}