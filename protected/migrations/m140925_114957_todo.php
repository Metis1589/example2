<?php

class m140925_114957_todo extends CDbMigration
{
	public function up()
	{
            $this->createTable('todo', array(
                'id'=>'pk',
                'description'=>'text NOT NULL',
                'category'=>'enum(\'home\',\'work\',\'outdoor\') NOT NULL',
                'is_complted'=>'tinyint(1) NOT NULL DEFAULT 0',
                'priority'=>'int(11) NOT NULL DEFAULT 1',
                'date_create'=>'datetime NOT NULL',
                'date_update'=>'datetime NOT NULL',
            ), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
	}

	public function down()
	{
		$this->dropTable('todo');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}