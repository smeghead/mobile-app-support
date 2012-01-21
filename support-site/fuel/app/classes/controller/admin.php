<?php
class Controller_Admin extends Controller_Template {
  public $template = 'admin/template';

  /**
   * Make before() compatible with Controller_Template by adding $data = null as a parameter
   */
  public function before($data = null) {
    parent::before(); // Without this line, templating won't work!

    // do stuff
  }

  public function action_index() {
    $data = array();
    $this->template->title = 'Androidアプリサポート PaRappa';
    $this->template->side_menu = View::forge('admin/public_side_menu', $data);
    $this->template->content = View::forge('admin/index', $data);
  }

}
?>
