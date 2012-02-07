<?php

namespace Fuel\Migrations;

class Create_inquiry_bases
{
	public function up()
	{
		\DBUtil::create_table('inquiry_bases', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'app_id' => array('constraint' => 11, 'type' => 'int'),
			'status' => array('constraint' => 11, 'type' => 'int'),
			'asked_at' => array('constraint' => 11, 'type' => 'int'),
			'answered_at' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('inquiry_bases');
	}
}
