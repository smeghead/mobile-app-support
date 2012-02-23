<?php

namespace Fuel\Migrations;

class Delete_user_id_from_users
{
  public function up()
  {
    \DBUtil::drop_fields('users', 'user_id');
  }

  public function down()
  {
    \DBUtil::add_fields('users', array(
      'user_id' => array('constraint' => 255, 'type' => 'varchar'),
    ));
  }
}
