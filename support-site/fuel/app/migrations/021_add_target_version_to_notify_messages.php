<?php

namespace Fuel\Migrations;

class Add_target_version_to_notify_messages
{
	public function up()
	{
    \DBUtil::add_fields('notify_messages', array(
						'target_version' => array('constraint' => 6, 'type' => 'int', 'null' => true),

    ));	
	}

	public function down()
	{
    \DBUtil::drop_fields('notify_messages', array(
			'target_version'    
    ));
	}
}
