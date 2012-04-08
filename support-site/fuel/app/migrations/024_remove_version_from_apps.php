<?php

namespace Fuel\Migrations;

class Remove_version_from_apps
{
	public function up()
	{
    \DBUtil::drop_fields('apps', array(
			'version'    
    ));

	}

	public function down()
	{
    \DBUtil::add_fields('apps', array(
						'version' => array('constraint' => 16, 'type' => 'varchar'),

    ));	
	}
}
