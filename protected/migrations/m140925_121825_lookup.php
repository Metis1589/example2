<?php

class m140925_121825_lookup extends CDbMigration
{
	public function up()
	{
            $this->createTable('lookup', array(
                'id'=>'pk',
                'name'=>'varchar(128) NOT NULL',
                'code'=>'varchar(30) NOT NULL',
                'type'=>'varchar(128) NOT NULL',
                'position'=>'int(11) NOT NULL',
            ), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
            
            $this->insert('lookup',array(
                'name' => 'At home',
                'code' => 'home',
                'type' => 'task_category',
                'position'=> 1
            ));
            
            $this->insert('lookup',array(
                'name' => 'At work',
                'code' => 'work',
                'type' => 'task_category',
                'position'=> 2
            ));
            
            $this->insert('lookup',array(
                'name' => 'Outdoor',
                'code' => 'outdoor',
                'type' => 'task_category',
                'position'=> 3
            ));
	}

	public function down()
	{
		$this->dropTable('lookup');
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