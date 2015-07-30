<?php

use yii\db\Schema;
use yii\db\Migration;

class m150727_122352_alter_rating_table extends Migration {
	public function up() {
		$this->alterColumn('{{%ratings}}', 'created_at', Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP');
		$this->alterColumn('{{%ratings}}', 'updated_at', Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');

	}

	public function down() {
		$this->alterColumn('{{%ratings}}', 'created_at', Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
		$this->alterColumn('{{%ratings}}', 'updated_at', Schema::TYPE_INTEGER . ' NOT NULL');
		echo "m150727_122352_alter_rating_table cannot be reverted.\n";

		return false;
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
