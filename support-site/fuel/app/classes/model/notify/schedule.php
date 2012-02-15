<?php

class Model_Notify_Schedule extends \Orm\Model
{
  protected static $_properties = array(
    'id',
    'app_id',
    'notify_at',
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

  protected static $_has_many = array('notify_messages');
}
