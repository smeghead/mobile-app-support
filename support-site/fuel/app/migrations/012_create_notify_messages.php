<?php

namespace Fuel\Migrations;

class Create_notify_messages
{
	public function up()
	{
		\DBUtil::create_table('notify_messages', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'notify_schedule_id' => array('constraint' => 11, 'type' => 'int'),
			'locale' => array('constraint' => 2, 'type' => 'varchar'),
			'subject' => array('constraint' => 64, 'type' => 'varchar'),
			'content' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('notify_messages');
	}
}