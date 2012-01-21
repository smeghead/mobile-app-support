<?php
class Controller_Public extends Controller_Template {
  public $template = 'public/template';

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
    $this->template->side_menu = View::forge('public/side_menu', $data);
    $this->template->content = View::forge('public/index', $data);
  }

  public function action_register() {
    if (Input::method() == 'POST') {
      Log::debug('posted');
      $validation = Validation::forge();
       
      $validation->add_field('user_id', 'ユーザID', 'required|match_pattern[#[A-Za-z0-9_]+#]|min_length[4]|max_length[24]');
      $validation->add_field('passwd', 'パスワード', 'required|min_length[8]|max_length[24]');
      $validation->add_field('email', 'メールアドレス', 'required|valid_email');
       
      if (!$validation->run()) {
        Log::debug('validation failed');
        $data = array(
          'errors' => $validation->error()
        );
        $this->template->title = 'Androidアプリサポート PaRappa';
        $this->template->side_menu = View::forge('public/side_menu', $data);
        $this->template->content = View::forge('public/register', $data);
        return;
      }
      Log::debug('validation ok');
      return Response::redirect('public/complete');
    }
    $data = array();
    $this->template->title = 'Androidアプリサポート PaRappa';
    $this->template->side_menu = View::forge('public/side_menu', $data);
    $this->template->content = View::forge('public/register', $data);
  }

  public function action_complete() {
    $data = array();
    $this->template->title = 'Androidアプリサポート PaRappa';
    $this->template->side_menu = View::forge('public/side_menu', $data);
    $this->template->content = View::forge('public/complete', $data);
  }
}
?>
