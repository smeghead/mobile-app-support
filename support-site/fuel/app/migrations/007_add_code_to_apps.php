<?php

namespace Fuel\Migrations;

class Add_code_to_apps
{
	public function up()
	{
    \DBUtil::add_fields('apps', array(
						'code' => array('constraint' => 16, 'type' => 'varchar'),

    ));	
	}

	public function down()
	{
    \DBUtil::drop_fields('apps', array(
			'code'    
    ));
	}
}
