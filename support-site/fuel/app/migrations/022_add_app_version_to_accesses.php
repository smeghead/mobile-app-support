<?php

namespace Fuel\Migrations;

class Add_app_version_to_accesses
{
	public function up()
	{
    \DBUtil::add_fields('accesses', array(
						'app_version' => array('constraint' => 6, 'type' => 'int', 'null' => true),

    ));	
	}

	public function down()
	{
    \DBUtil::drop_fields('accesses', array(
			'app_version'    
    ));
	}
}
