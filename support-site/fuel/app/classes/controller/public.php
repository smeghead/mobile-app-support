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

  public function action_support() {
    $data = array();
    $this->template->title = 'Androidアプリサポート PaRappa';
    $this->template->side_menu = View::forge('public/side_menu', $data);
    $this->template->content = View::forge('public/support', $data);
  }

  public function action_notification() {
    $data = array();
    $this->template->title = 'Androidアプリサポート PaRappa';
    $this->template->side_menu = View::forge('public/side_menu', $data);
    $this->template->content = View::forge('public/notification', $data);
  }

  public function action_analysis() {
    $data = array();
    $this->template->title = 'Androidアプリサポート PaRappa';
    $this->template->side_menu = View::forge('public/side_menu', $data);
    $this->template->content = View::forge('public/analysis', $data);
  }

  public function action_register() {
    if (Input::method() == 'POST') {
      Log::debug('posted');
      $validation = Validation::forge();
      $validation->add_callable('Appvalidation');
       
      $validation->add_field('user_id', 'ユーザID', 'required|valid_string[alpha,numeric,punctuation,dashes]|min_length[4]|max_length[24]|unique[users.user_id]');
      $validation->add_field('passwd', 'パスワード', 'required|min_length[8]|max_length[24]');
      $validation->add_field('email', 'メールアドレス', 'required|valid_email|unique[users.email]');
       
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

      $user_values = array(
        'user_id' => $validation->validated('user_id'),
        'passwd' => hash('ripemd160', $validation->validated('passwd')),
        'email' => $validation->validated('email'),
        'deleted' => 0
      );
      $user = new Model_User($user_values);
      $user->save();
      #mail
      $mail_config = \Config::load('mail');
      Log::debug(var_export($mail_config, true));
      $header = 'From: ' . $mail_config['basic']['from'] . "\n" .
        'Bcc: ' . $mail_config['basic']['bcc'] . "\n";
      $body = $mail_config['register_mail']['body'];
      $body = str_replace('#user_id', $validation->validated('user_id'), $body);
      Log::debug('to: ' . $validation->validated('email'));
      Log::debug('subject: ' . $mail_config['register_mail']['subject']);
      Log::debug('additional header: ' . $header);
      Log::debug('body: ' . $body);
      if (!mb_send_mail(
          $validation->validated('email'),
          $mail_config['register_mail']['subject'],
          $body,
          $header)) {
        Log::error('failed to send register mail.');
        die('failed to send mail.');
      }
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
