<?php

namespace Fuel\Migrations;

class Add_category_to_apps
{
	public function up()
	{
    \DBUtil::add_fields('apps', array(
						'category' => array('constraint' => 2, 'type' => 'int'),

    ));	
	}

	public function down()
	{
    \DBUtil::drop_fields('apps', array(
			'category'    
    ));
	}
}