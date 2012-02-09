<?php

namespace Fuel\Migrations;

class Create_accesses
{
	public function up()
	{
		\DBUtil::create_table('accesses', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'app_id' => array('constraint' => 11, 'type' => 'int'),
			'terminal_id' => array('constraint' => 16, 'type' => 'varchar'),
			'type' => array('constraint' => 11, 'type' => 'int'),
			'user_agent' => array('constraint' => 1024, 'type' => 'varchar'),
			'remote_addr' => array('constraint' => 64, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('accesses');
	}
}