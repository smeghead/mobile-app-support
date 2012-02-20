<?php

namespace Fuel\Migrations;

class Add_activity_to_notify_messages
{
	public function up()
	{
    \DBUtil::add_fields('notify_messages', array(
						'activity' => array('constraint' => 1024, 'type' => 'varchar'),

    ));	
	}

	public function down()
	{
    \DBUtil::drop_fields('notify_messages', array(
			'activity'    
    ));
	}
}