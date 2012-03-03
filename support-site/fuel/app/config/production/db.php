<?php
/**
 * The production database settings.
 */

return array(
  'active' => 'production',

  'production' => array(
    'type'           => 'mysqli',
    'connection'  => array(
      'hostname'       => 'localhost',
      'port'           => '3306',
      'database'       => 'parappa',
      'username'       => 'rapper',
      'password'       => 'fugafuga',
      'persistent'     => false,
    ),
    'table_prefix'   => '',
    'charset'        => 'utf8',
    'caching'        => false,
    'profiling'      => false,
  ),
);
