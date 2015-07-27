<?php
namespace app\widgets;

use \yii\bootstrap\Widget as Widget;
use app\models\ObjectRatings;

class RatingWidget extends Widget {
	public $object_id;

	public function init() {
	}

	public function run() {
		$rating = new ObjectRatings();
		$rating->getRatingByObjectID($this->object_id);

		return $this->render('@app/views/rating/view', [
			'rating' => $rating,
		]);
	}
}