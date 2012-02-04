<?php

class Model_App extends \Orm\Model
{
  protected static $_properties = array(
    'id',
    'user_id',
    'name',
    'url',
    'code',
    'deleted',
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

  public static function get_uniq_code() {
    $code = substr(md5(date("YmdD His")), 0, 8); 
    if (Model_App::find('count', array('where' => array('code' => $code))) == 0) {
      return $code;
    }
    throw new Exception('failed to create uniq code.');
  }
}
