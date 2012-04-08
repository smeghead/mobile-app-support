<?php

namespace Fuel\Migrations;

class Add_action_type_to_notify_messages
{
	public function up()
	{
    \DBUtil::add_fields('notify_messages', array(
						'action_type' => array('constraint' => 1, 'type' => 'int'),

    ));	
	}

	public function down()
	{
    \DBUtil::drop_fields('notify_messages', array(
			'action_type'    
    ));
	}
}