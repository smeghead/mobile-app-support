<?php
function h($str) {
  return htmlspecialchars($str, ENT_QUOTES);
}

class Util {
  public static function get_terminal_id() {
    $terminal_id = Cookie::get('_PARAPPA_ID', '');
    if (!$terminal_id) {
      $terminal_id = Util::get_random_string(16);
      Log::info('create _PARAPPA_ID: ' . $terminal_id);
    }
    Cookie::set('_PARAPPA_ID', $terminal_id, 60 * 60 * 24 * 365);
    return $terminal_id;
  }

  public static function get_random_string($length) {
    $strinit = "abcdefghkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ012345679"; 
    $strarray = preg_split("//", $strinit, 0, PREG_SPLIT_NO_EMPTY); 

    for ($i = 0; $i < 30; $i++) {
      $random = '';
      for ($i = 0; $i < $length; $i++) { 
        $random .= $strarray[array_rand($strarray, 1)]; 
      } 
      if (!preg_match('/^[0-9]+$/', $random)) {
        return $random;
      }
    }
    throw new Exception('failed create random string.');
  }
}
?>
