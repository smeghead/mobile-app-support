<?php

namespace Fuel\Migrations;

class Add_version_to_accesses
{
	public function up()
	{
    \DBUtil::add_fields('accesses', array(
						'version' => array('constraint' => 16, 'type' => 'varchar', 'null' => true),

    ));	
	}

	public function down()
	{
    \DBUtil::drop_fields('accesses', array(
			'version'    
    ));
	}
}
