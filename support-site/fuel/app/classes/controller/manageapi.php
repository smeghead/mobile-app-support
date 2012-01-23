<?php
class Controller_Manageapi extends Controller_Rest {

  /**
   * Make before() compatible with Controller_Template by adding $data = null as a parameter
   */
  public function before($data = null) {
    parent::before(); // Without this line, templating won't work!
    $this->auto_render = false;

    $user = Session::get('user');
    Log::debug(var_export($user, true));
    Log::debug($this->request->action);
    if (!$user) {
      return $this->response(array('error' => 'session timeout'));
    }
  }

  public function get_list() {
    $this->response(array());
  }
}
?>
