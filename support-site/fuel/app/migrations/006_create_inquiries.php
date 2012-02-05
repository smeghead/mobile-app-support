<?php

namespace Fuel\Migrations;

class Create_inquiries
{
	public function up()
	{
		\DBUtil::create_table('inquiries', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'app_id' => array('constraint' => 11, 'type' => 'int'),
			'email' => array('constraint' => 256, 'type' => 'varchar'),
			'answer_to' => array('constraint' => 11, 'type' => 'int', 'default' => 0),
			'content' => array('type' => 'text'),
			'status' => array('constraint' => 11, 'type' => 'int'),
			'asked_at' => array('constraint' => 11, 'type' => 'int'),
			'answered_at' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('inquiries');
	}
}
