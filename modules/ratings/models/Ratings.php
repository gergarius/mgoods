<?php

namespace app\modules\ratings\models;

use Yii;

/**
 * This is the model class for table "ratings".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $updated_by_user_id
 * @property integer $object_id
 * @property integer $shop_id
 * @property integer $good_id
 * @property integer $rating
 * @property string  $name
 * @property string  $pluses
 * @property string  $minuses
 * @property string  $email
 * @property string  $comment
 * @property integer $status
 */
class Ratings extends \yii\db\ActiveRecord {

	const STATUS_BLOCKED = 0;
	const STATUS_ACTIVE = 1;
	const STATUS_WAIT = 2;

	const BAD_RAIT = 1;
	const NOT_NICE_RAIT = 2;
	const NORMAL_RAIT = 3;
	const NICE_RAIT = 4;
	const AWESOME_RAIT = 5;

	/**
	 * @var string
	 */
	public $verifyCode;

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'ratings';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			//[['name', 'email', 'subject', 'body'], 'required'],
			[['created_at', 'updated_at', 'name', 'email', 'comment'], 'required'],
			[['created_at', 'updated_at', 'updated_by_user_id', 'object_id', 'shop_id', 'good_id', 'rating', 'status'], 'integer'],
			[['comment'], 'string'],
			[['name', 'email'], 'trim'],
			[['name', 'email'], 'string', 'max' => 255],
			['email', 'email'],
			[['pluses', 'minuses'], 'string', 'max' => 256],
			['verifyCode', 'required'],
			['verifyCode', 'captcha', 'captchaAction' => '/object/captcha',],
			[['object_id', 'shop_id', 'good_id'], 'validateRatingRelation'],
			['updated_by_user_id', 'validateUserId'],
		];
	}

	public function validateRatingRelation() {
		if (!$this->object_id && !$this->shop_id && !$this->good_id) {
			$this->addError('object_id', 'Please set rating relation');
		}
	}

	public function validateUserId() {
		if (!$this->isNewRecord && !$this->updated_by_user_id) {
			$this->addError('updated_by_user_id', 'Please set updated user ID');
		}
	}

	public function getStatusName() {
		$statuses = self::getStatusesArray();

		return isset($statuses[$this->status]) ? $statuses[$this->status] : '';
	}

	public static function getStatusesArray() {
		return [
			self::STATUS_BLOCKED => Yii::t('app', 'USER_STATUS_BLOCKED'),
			self::STATUS_ACTIVE  => Yii::t('app', 'USER_STATUS_ACTIVE'),
			self::STATUS_WAIT    => Yii::t('app', 'USER_STATUS_WAIT'),
		];
	}

	public static function getRatingsArray() {
		return [
			self::BAD_RAIT      => Yii::t('app', 'BAD_RAIT'),
			self::NOT_NICE_RAIT => Yii::t('app', 'NOT_NICE_RAIT'),
			self::NORMAL_RAIT   => Yii::t('app', 'NORMAL_RAIT'),
			self::NICE_RAIT     => Yii::t('app', 'NICE_RAIT'),
			self::AWESOME_RAIT  => Yii::t('app', 'AWESOME_RAIT'),
		];
	}


	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id'                 => Yii::t('app', 'ID') . ":",
			'created_at'         => Yii::t('app', 'Created At') . ":",
			'updated_at'         => Yii::t('app', 'Updated At') . ":",
			'updated_by_user_id' => Yii::t('app', 'Updated By User ID') . ":",
			'object_id'          => Yii::t('app', 'Object ID') . ":",
			'shop_id'            => Yii::t('app', 'Shop ID') . ":",
			'good_id'            => Yii::t('app', 'Good ID') . ":",
			'rating'             => Yii::t('app', 'Rating') . ":",
			'name'               => Yii::t('app', 'CONTACT_NAME') . ":",
			'pluses'             => Yii::t('app', 'Pluses') . ":",
			'minuses'            => Yii::t('app', 'Minuses') . ":",
			'email'              => Yii::t('app', 'CONTACT_EMAIL') . ":",
			'comment'            => Yii::t('app', 'RATING_RECALL') . ":",
			'status'             => Yii::t('app', 'Status') . ":",
		];
	}

	//Получения ссылки данных
	public static function getActiveRating($type, $id) {
		//avalible $type values object_id, shop_id, good_id
		return self::find()->where([$type => $id, 'status' => self::STATUS_ACTIVE])->orderBy('created_at DESC');
	}

	public function beforeValidate($event) {
		if (parent::beforeValidate($event)) {
			/*
			On save
			<?= $form->field($model, 'created_at')->textInput() ?>
		    <?= $form->field($model, 'updated_at')->textInput() ?>
		    <?= $form->field($model, 'updated_by_user_id')->textInput() ?>
			*/

			if ($this->isNewRecord) {
				$this->created_at = date('Y-m-d H:s:m', time());
			}
			if (Yii::$app->user->id) {
				$this->updated_by_user_id = id;
			}
			$this->updated_at = date('Y-m-d H:s:m', time());

			// ...custom code here...
			return true;
		} else {
			return false;
		}
	}

}
