<?php
function h($str) {
}
class Util {
  public static function get_terminal_id() {
    $terminal_id = Cookie::get('_PARAPPA_ID', '');
    if (!$terminal_id) {
      Log::info('create _PARAPPA_ID: ' . $terminal_id);
      $terminal_id = md5(date("YmdD His"));
    }
    Cookie::set('_PARAPPA_ID', $terminal_id, 60 * 60 * 24 * 365);
    return $terminal_id;
  }
}
?>
