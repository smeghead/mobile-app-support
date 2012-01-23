<?php

namespace Fuel\Migrations;

class Create_apps
{
	public function up()
	{
		\DBUtil::create_table('apps', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'name' => array('constraint' => 64, 'type' => 'varchar'),
			'url' => array('type' => 'text'),
			'deleted' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('apps');
	}
}