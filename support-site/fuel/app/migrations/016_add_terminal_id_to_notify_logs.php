<?php

namespace Fuel\Migrations;

class Add_terminal_id_to_notify_logs
{
	public function up()
	{
    \DBUtil::add_fields('notify_logs', array(
						'terminal_id' => array('constraint' => 16, 'type' => 'varchar'),

    ));	
	}

	public function down()
	{
    \DBUtil::drop_fields('notify_logs', array(
			'terminal_id'    
    ));
	}
}