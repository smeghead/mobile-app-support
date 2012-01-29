<?php

namespace Fuel\Migrations;

class Create_top_contents
{
	public function up()
	{
		\DBUtil::create_table('top_contents', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'content' => array('type' => 'text'),
			'enabeld' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('top_contents');
	}
}