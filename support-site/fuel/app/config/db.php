<?php
/**
 * Base Database Config.
 *
 * See the individual environment DB configs for specific config information.
 */

return array(
	'active' => 'development',

  'development' => array(
    'type'           => 'mysqli',
    'connection'     => array(
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
	/**
	 * Base config, just need to set the DSN, username and password in env. config.
	 */
	'default' => array(
		'type'        => 'pdo',
		'connection'  => array(
			'persistent' => false,
		),
		'identifier'   => '`',
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => false,
		'profiling'    => false,
	),

	'redis' => array(
		'default' => array(
			'hostname'  => '127.0.0.1',
			'port'      => 6379,
		)
	),
);
