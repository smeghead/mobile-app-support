<?php

namespace Fuel\Migrations;

class Create_users
{
  public function up()
  {
    \DBUtil::create_table('users', array(
      'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
      'user_id' => array('constraint' => 255, 'type' => 'varchar'),
      'passwd' => array('constraint' => 255, 'type' => 'varchar'),
      'email' => array('constraint' => 255, 'type' => 'varchar'),
      'deleted' => array('constraint' => 1, 'type' => 'int', 'default' => 0),
      'created_at' => array('constraint' => 11, 'type' => 'int'),
      'updated_at' => array('constraint' => 11, 'type' => 'int'),
    ), array('id'));
    \DBUtil::create_index('users', 'user_id', 'users_user_id', 'UNIQUE');
    \DBUtil::create_index('users', 'email', 'users_email', 'UNIQUE');
  }

  public function down()
  {
    \DBUtil::drop_table('users');
  }
}
