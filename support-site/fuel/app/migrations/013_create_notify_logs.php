<?php

namespace Fuel\Migrations;

class Create_notify_logs
{
	public function up()
	{
		\DBUtil::create_table('notify_logs', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'app_id' => array('constraint' => 11, 'type' => 'int'),
			'notify_schedule_id' => array('constraint' => 11, 'type' => 'int'),
			'locale' => array('constraint' => 2, 'type' => 'varchar'),
			'notified_at' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('notify_logs');
	}
}