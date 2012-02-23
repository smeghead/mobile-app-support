<?php
/**
 * The production database settings.
 */

return array(
  'active' => 'production',

  'default' => array(
    'type'           => 'mysqli',
    'connection'  => array(
      'hostname'       => 'localhost',
      'port'           => '3306',
      'database'       => 'parappa',
      'username'       => 'rapper',
      'password'       => 'fugafuga',
      'persistent'     => false,
    ),
  ),
);
