<?php

class Model_Access extends \Orm\Model
{
  public static $TYPE_INIT = 1;
  public static $TYPE_SITE_ACCESS = 2;

  protected static $_properties = array(
    'id',
    'app_id',
    'type',
    'activity',
    'terminal_id',
    'user_agent',
    'remote_addr',
    'created_at',
    'updated_at'
  );

  protected static $_observers = array(
    'Orm\Observer_CreatedAt' => array(
      'events' => array('before_insert'),
      'mysql_timestamp' => false,
    ),
    'Orm\Observer_UpdatedAt' => array(
      'events' => array('before_save'),
      'mysql_timestamp' => false,
    ),
  );
}
