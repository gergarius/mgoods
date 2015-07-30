<?php

use yii\db\Schema;
use yii\db\Migration;

class m150726_173504_create_rating_table extends Migration {
	public function up() {

		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%ratings}}', [
			'id'                 => Schema::TYPE_PK,
			'created_at'         => Schema::TYPE_INTEGER . ' NOT NULL',
			'updated_at'         => Schema::TYPE_INTEGER . ' NOT NULL',
			'updated_by_user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
			'object_id'          => Schema::TYPE_INTEGER . ' NOT NULL',
			'shop_id'            => Schema::TYPE_INTEGER . ' NOT NULL',
			'good_id'            => Schema::TYPE_INTEGER . ' NOT NULL',
			'rating'             => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 5',
			'name'               => Schema::TYPE_STRING . ' NOT NULL',
			'pluses'             => Schema::TYPE_STRING . '(256) NULL DEFAULT NULL',
			'minuses'            => Schema::TYPE_STRING . '(256) NULL DEFAULT NULL',
			'email'              => Schema::TYPE_STRING . ' NOT NULL',
			'comment'            => Schema::TYPE_TEXT . ' NOT NULL',
			'email'              => Schema::TYPE_STRING . ' NOT NULL',
			'status'             => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
		], $tableOptions);

		$this->createIndex('idx_rating_username', '{{%user}}', 'username');
		$this->createIndex('idx_rating_email', '{{%user}}', 'email');
		$this->createIndex('idx_rating_status', '{{%user}}', 'status');
	}

	public function down() {
		echo "m150724_212831_create_user_table dropTable user.\n";
		$this->dropTable('{{%ratings}}');
	}


	/*
	// Use safeUp/safeDown to run migration code within a transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
