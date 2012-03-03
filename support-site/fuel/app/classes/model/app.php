<?php

class Model_App extends \Orm\Model
{
  protected static $_properties = array(
    'id',
    'user_id',
    'name',
    'url',
    'category',
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

  protected static $_has_many = array(
    'inquiry_bases' => array(
      'model_to' => 'Model_Inquiry_Base',
    )
  );

  public static function get_uniq_code() {
    $code = substr(md5(date("YmdD His")), 0, 8); 
    $query = Model_App::find('all', array('where' => array('code' => $code)));
    if (count($query) == 0) {
      return $code;
    }
    throw new Exception('failed to create uniq code.');
  }
}
