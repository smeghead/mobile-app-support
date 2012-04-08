<?php

class Model_Access extends \Orm\Model
{
  public static $TYPE_INIT = 1;               //SDKによる初期化
  public static $TYPE_SITE_ACCESS = 2;        //サポートサイトアクセス
  public static $TYPE_SITE_ACCESS_NOTIFY = 3; //通知表示からの通知内容表示
  public static $TYPE_NOTIFY_CHECK = 4;       //SDKからの通知存在確認アクセス

  protected static $_properties = array(
    'id',
    'app_id',
    'type',
    'activity',
    'terminal_id',
    'user_agent',
    'remote_addr',
    'version',
    'app_version',
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
where
  app_id = $app_id
  and type in (1)
  and created_at between $begin and $end
group by d;
EOS;
    $result = DB::query($sql)->execute();
    return $result->as_array();
  }
}
