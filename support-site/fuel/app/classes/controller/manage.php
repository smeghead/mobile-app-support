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
//    Log::debug(var_export($user, true));
    Log::debug($this->request->uri);
    if (!$user && !in_array($this->request->action, $this->NO_AUTH_ACTIONS)) {
      return Response::redirect('manage/login');
    }
    $user = Session::get('user');
    $this->template->title = 'Androidアプリサポート PaRappa';
    $this->template->user_name = $user ? $user->user_id : '';
    $apps = Model_App::find(
      'all',
      array(
        'where' => array(
          'user_id' => $user['id'],
          'deleted' => 0,
        )
      )
    );
    $data['apps'] = $apps;
    $this->template->side_menu = View::forge('manage/side_menu', $data);
  }

  public function action_index() {
    $user = Session::get('user');
    $apps = Model_App::find(
      'all',
      array(
        'where' => array(
          'user_id' => $user['id'],
          'deleted' => 0,
        )
      )
    );
    $data = array(
      'apps' => $apps,
    );
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

  public function action_logout() {
    Session::delete('user');
    return Response::redirect('public/');
  }

  public function action_add_app() {
    $data = array();
    if (Input::method() == 'POST') {
      Log::debug('try to add_app.');
      $validation = Validation::forge();
      $validation->add_callable('Appvalidation');
       
      $validation->add_field('name', 'アプリ名', 'required');
      $validation->add_field('url', 'Android Market URL', 'required|valid_url');
       
      if (!$validation->run()) {
        Log::debug('validation failed');
        $data['errors'] = $validation->error();
        $this->template->content = View::forge('manage/add_app', $data);
        return $this->template;
      }

      $user = Session::get('user');
      $app_value = array(
        'user_id' => $user['id'],
        'name' => $validation->validated('name'),
        'url' => $validation->validated('url'),
        'deleted' => 0
      );
      Log::debug(var_export($app, true));
      $app = new Model_App($app_value);
      $app->save();
      return Response::redirect('manage/');
    }
    Log::debug(var_export($data, true));
    $this->template->content = View::forge('manage/add_app', $data);
    return $this->template;
  }

  public function action_app($app_id) {
    $user = Session::get('user');
    $app = Model_App::find('first',
      array(
        'id' => $app_id,
        'user_id' => $user['id'],
      )
    );
    if (!$app) {
      return Response::forge(ViewModel::forge('welcome/404'), 404);
    }
    $data = array(
      'app' => $app
    );
    $this->template->content = View::forge('manage/app', $data);
    return $this->template;
  }

  public function action_app_site($app_id) {
    Log::debug('---------------------------');
    Log::debug('action_app_site id:' . var_export($app_id, true));
    $user = Session::get('user');
    Log::debug('action_app_site user_id:' . $user['id']);
    $app = Model_App::find('first', array(
        'where' => array(
          'id' => $app_id,
          'user_id' => $user['id'],
        )
      )
    );
//    Log::debug(var_export($app, true));
    if (!$app) {
      Log::error('no app.');
      return Response::forge(ViewModel::forge('welcome/404'), 404);
    }
    Log::debug('app exists.');
    $data = array(
      'app' => $app
    );
    $this->template->content = View::forge('manage/app_site', $data);
    return $this->template;
  }

  public function action_app_notify($app_id) {
    $user = Session::get('user');
    $app = Model_App::find('first',
      array(
        'id' => $app_id,
        'user_id' => $user['id'],
      )
    );
    if (!$app) {
      return Response::forge(ViewModel::forge('welcome/404'), 404);
    }
    $data = array(
      'app' => $app
    );
    $this->template->content = View::forge('manage/app_notify', $data);
    return $this->template;
  }

  public function action_app_analysis($app_id) {
    $user = Session::get('user');
    $app = Model_App::find('first',
      array(
        'id' => $app_id,
        'user_id' => $user['id'],
      )
    );
    if (!$app) {
      return Response::forge(ViewModel::forge('welcome/404'), 404);
    }
    $data = array(
      'app' => $app
    );
    $this->template->content = View::forge('manage/app_analysis', $data);
    return $this->template;
  }
}
?>
