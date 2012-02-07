<?php

namespace Fuel\Migrations;

class Create_inquiry_messages
{
	public function up()
	{
		\DBUtil::create_table('inquiry_messages', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'inquiry_base_id' => array('constraint' => 11, 'type' => 'int'),
			'email' => array('constraint' => 256, 'type' => 'varchar'),
			'content' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('inquiry_messages');
	}
}