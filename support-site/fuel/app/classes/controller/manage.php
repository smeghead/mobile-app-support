<?php
class Controller_Manage extends Controller_Template {
  public $template = 'manage/template';
  public $NO_AUTH_ACTIONS = array(
    'login',
    'logout'
  );

  /**
   * Make before() compatible with Controller_Template by adding $data = null as a parameter
   */
  public function before($data = null) {
    parent::before(); // Without this line, templating won't work!
    $this->auto_render = false;

    $user = Session::get('user');
    Log::debug(var_export($user, true));
    Log::debug($this->request->action);
    if (!$user && !in_array($this->request->action, $this->NO_AUTH_ACTIONS)) {
      return Response::redirect('manage/login');
    }
  }

  public function action_index() {
    $data = array();
    $this->template->title = 'Androidアプリサポート PaRappa';
    $this->template->side_menu = View::forge('manage/side_menu', $data);
    $this->template->content = View::forge('manage/index', $data);
    return $this->template;
  }

  public function action_login() {
    $data = array(
      'title' => 'Androidアプリサポート PaRappa'
    );
    if (Input::method() == 'POST') {
      Log::debug('try to login.');
      $validation = Validation::forge();
      $validation->add_callable('Appvalidation');
       
      $validation->add_field('user_id', 'ユーザID', 'required|match_pattern[#^[A-Za-z0-9_]+$#]');
      $validation->add_field('passwd', 'パスワード', 'required');
       
      if (!$validation->run()) {
        Log::debug('validation failed');
        $data['errors'] = $validation->error();
        return View::forge('manage/login', $data); 
      }
      $user = Model_User::find('first', array(
        'where' => array(
          'user_id' => $validation->validated('user_id'),
          'passwd' => hash('ripemd160', $validation->validated('passwd'))
        )
      ));
      if (!$user) {
        $data['errors'] = array('login_error' => 'ユーザIDまたはパスワードが違っています。');
        return View::forge('manage/login', $data); 
      }
      Log::debug(var_export($user, true));
      Session::set('user', $user);
      return Response::redirect('manage/');
    }
    Log::debug(var_export($data, true));
    return View::forge('manage/login', $data); 
  }
}
?>
