<?php

namespace Fuel\Migrations;

class Add_package_name_to_apps
{
	public function up()
	{
    \DBUtil::add_fields('apps', array(
						'package_name' => array('constraint' => 1024, 'type' => 'varchar'),

    ));	
	}

	public function down()
	{
    \DBUtil::drop_fields('apps', array(
			'package_name'    
    ));
	}
}