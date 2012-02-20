<?php

class Model_Access extends \Orm\Model
{
  public static $TYPE_INIT = 1;
  public static $TYPE_SITE_ACCESS = 2;
  public static $TYPE_SITE_ACCESS_NOTIFY = 3;

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

  public static function get_accesses($app_id, $begin, $end) {
    Log::debug('app_id:' . $app_id);
    if (count(array_filter(array($app_id, $begin, $end), 'is_numeric')) != 3) {
      die('argument error.');
    }
    $app_id = DB::escape($app_id);
    $begin = DB::escape($begin);
    $end = DB::escape($end);
    $sql =<<<EOS
select from_unixtime(created_at, '%Y-%m-%d') as d, count(*) as count
from accesses
where app_id = $app_id and created_at between $begin and $end
group by d;
EOS;
    $result = DB::query($sql)->execute();
    return $result->as_array();
  }
}
