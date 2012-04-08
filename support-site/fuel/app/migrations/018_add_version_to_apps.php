<?php

namespace Fuel\Migrations;

class Add_version_to_apps
{
	public function up()
	{
    \DBUtil::add_fields('apps', array(
						'bio' => array('constraint' => 16, 'type' => 'varchar'),

    ));	
	}

	public function down()
	{
    \DBUtil::drop_fields('apps', array(
			'bio'    
    ));
	}
}