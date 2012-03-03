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
    $this->template->title = \Config::get('app_name') . " 管理";
    $this->template->email = $user ? $user->email : '';
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
      'title' => \Config::get('app_name'),
    );
    if (Input::method() == 'POST') {
      Log::debug('try to login.');
      $validation = Validation::forge();
      $validation->add_callable('Appvalidation');
       
      $validation->add_field('email', 'メールアドレス', 'required|valid_email');
      $validation->add_field('passwd', 'パスワード', 'required');
       
      if (!$validation->run()) {
        Log::debug('validation failed');
        $data['errors'] = $validation->error();
        return View::forge('manage/login', $data); 
      }
      $user = Model_User::find('first', array(
        'where' => array(
          'email' => $validation->validated('email'),
          'passwd' => hash('ripemd160', $validation->validated('passwd'))
        )
      ));
      if (!$user) {
        $data['errors'] = array('login_error' => 'メールアドレスまたはパスワードが違っています。');
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
    $data = array(
      'app_categories' => Model_App_Category::find('all', array('where' => array('locale' => 'ja'))),
    );
    Log::debug(var_export($data['app_categories'], true));
    if (Input::method() == 'POST') {
      Log::debug('try to add_app.');
      $validation = Validation::forge();
      $validation->add_callable('Appvalidation');
       
      $validation->add_field('name', 'アプリ名', 'required');
      $validation->add_field('url', 'Android Market URL', 'required|valid_url');
      $validation->add_field('category', 'カテゴリ', 'required');
       
      if (!$validation->run()) {
        Log::debug('validation failed');
        $data['errors'] = $validation->error();
        $this->template->content = View::forge('manage/add_app', $data);
        return $this->template;
      }

      $user = Session::get('user');
      $code = Model_App::get_uniq_code();
      Log::debug('code:' . $code);
      $app_value = array(
        'user_id' => $user['id'],
        'name' => $validation->validated('name'),
        'url' => $validation->validated('url'),
        'category' => $validation->validated('category'),
        'code' => $code,
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
    $app = Model_App::find('first', array('where' => array(
          'id' => $app_id,
          'user_id' => $user['id'],
        )
      )
    );
    if (!$app) {
      Log::error('app not found.');
      return Response::forge(ViewModel::forge('public/404'), 404);
    }
    $data = array(
      'app' => $app,
      'app_categories' => Model_App_Category::find('all', array('where' => array('locale' => 'ja'))),
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
      return Response::forge(ViewModel::forge('public/404'), 404);
    }
    Log::debug('app exists.');
    $inquiries = Model_Inquiry_Base::find('all', array(
      'where' => array(
        'app_id' => $app->id
      ),
      'order_by' => array('asked_at' => 'desc'),
      'related' => array('inquiry_messages')
    ));
    $data = array(
      'app' => $app,
      'inquiries' => $inquiries
    );
    Log::debug('inquiry');
    $this->template->content = View::forge('manage/app_site', $data);
    return $this->template;
  }

  public function action_app_notify($app_id) {
    $user = Session::get('user');
    $app = Model_App::find('first', array(
        'where' => array(
          'id' => $app_id,
          'user_id' => $user['id'],
        )
      )
    );
    if (!$app) {
      Log::error('app not found.');
      return Response::forge(ViewModel::forge('public/404'), 404);
    }
    $notifies = Model_Notify_Schedule::find('all', array(
      'where' => array(
        'app_id' => $app->id,
      ),
      'related' => array('notify_messages')
    ));
    $data = array(
      'app' => $app,
      'notifies' => $notifies ? $notifies : array()
    );

    $this->template->content = View::forge('manage/app_notify', $data);
    return $this->template;
  }

  public function action_app_notify_edit($app_id, $id = null) {
    $user = Session::get('user');
    $app = Model_App::find('first', array(
        'where' => array(
          'id' => $app_id,
          'user_id' => $user['id'],
        )
      )
    );
    if (!$app) {
      Log::error('app not found.');
      return Response::forge(ViewModel::forge('public/404'), 404);
    }
    $notify = Model_Notify_Schedule::find('first', array(
      'where' => array(
        'app_id' => $app->id,
        'id' => $id
      ),
      'related' => array('notify_messages')
    ));
    Log::debug('notify:' . var_export($notify, true));
    if (!$notify) {
      Log::debug('new notify');
      $notify = new Model_Notify_Schedule();
      $notify->notify_at = time() + 60 * 60 * 24;
      $notify->notify_messages[] = new Model_Notify_Message();
    }
    $data = array(
      'app' => $app,
      'notify' => $notify
    );

    if (Input::method() == 'POST') {
      Log::debug('try to register.');

      $validation = Validation::forge();
      $validation->add_callable('Appvalidation');
       
      $validation->add_field('locale', 'ロケール', 'exact_length[2]');
      $validation->add_field('subject', 'タイトル', 'required');
      $validation->add_field('notify_at', '告知予定日時', 'required|match_pattern[#^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$#]');
      $validation->add_field('content', '告知内容', 'required');
      $validation->add_field('activity', '移動先Activity', 'required');
       
      if (!$validation->run()) {
        Log::debug('validation failed');
        $data['errors'] = $validation->error();
        $this->template->content = View::forge('manage/app_notify_edit', $data);
        return $this->template;
      }

      DB::start_transaction();
      try {
        Log::debug('transaction start');
        $notify->app_id = $app->id;
        $notify->notify_at = date_format(date_create($validation->validated('notify_at')), "U");
        if (count($notify->notify_messages) > 0) {
          $messages = array_values($notify->notify_messages);
          $message = $messages[0];
        } else {
          $message = new Model_Notify_Message();
        }
        $message->locale = $validation->validated('locale');
        $message->subject = $validation->validated('subject');
        $message->content = $validation->validated('content');
        $message->activity = $validation->validated('activity');
        $notify->notify_messages[0] = $message;
        Log::debug('transaction save');
        $notify->save();
        Log::debug('transaction commit');
        DB::commit_transaction();
        return Response::redirect('manage/app_notify/' . $app->id);
      } catch (Exception $e) {
        Log::debug('error: ' . $e->getMessage());
        DB::rollback_transaction();
        throw new Exception('failed to answer.');
      }
    }
    $this->template->content = View::forge('manage/app_notify_edit', $data);
    return $this->template;
  }

  public function action_app_analysis($app_id) {
    $user = Session::get('user');
    $app = Model_App::find('first', array(
      'where' => array(
          'id' => $app_id,
          'user_id' => $user['id'],
        )
      )
    );
    if (!$app) {
      Log::error('app not found.');
      return Response::forge(ViewModel::forge('public/404'), 404);
    }
    $data = array(
      'app' => $app
    );
    //TODO enable to change date priod.
    $end = time();
    $begin = $end - 60 * 60 * 24 * 30;
    $data['accesses'] = Model_Access::get_accesses($app->id, $begin, $end);

    $this->template->content = View::forge('manage/app_analysis', $data);
    return $this->template;
  }

  public function action_inquiry($app_id, $inquiry_id) {
    $user = Session::get('user');
    $app = Model_App::find('first', array('where' => array(
          'id' => $app_id,
          'user_id' => $user['id'],
        )
      )
    );
    if (!$app) {
      Log::error('app not found.');
      return Response::forge(ViewModel::forge('public/404'), 404);
    }
    $inquiry = Model_Inquiry_Base::find('first', array(
      'where' => array(
        'id' => $inquiry_id,
        'app_id' => $app->id
      ),
      'related' => array('inquiry_messages')
    ));
    if (!$inquiry) {
      Log::error('inquiry not found.');
      return Response::forge(ViewModel::forge('public/404'), 404);
    }
    $data = array(
      'app' => $app,
      'inquiry' => $inquiry
    );
    if (Input::method() == 'POST') {
      Log::debug('try to answer.');
      $answer = Input::post('answer');
      Log::debug($answer);
      $validation = Validation::forge();
      $validation->add_callable('Appvalidation');
       
      $validation->add_field('answer', '回答', 'required');
       
      if (!$validation->run()) {
        Log::debug('validation failed');
        $data['errors'] = $validation->error();
        $this->template->content = View::forge('manage/inquiry', $data);
        return $this->template;
      }

      DB::start_transaction();
      try {
        Log::debug('transaction start');
        $inquiry->inquiry_messages[] = new Model_Inquiry_Message(array(
            'email' => $user->email,
            'content' => $answer,
          )
        );
        Log::debug('transaction added message');
        $inquiry->status = 2;
        $inquiry->answered_at = time();
        Log::debug('transaction save');
        $inquiry->save();
        Log::debug('transaction commit');
        DB::commit_transaction();
        return Response::redirect('manage/app_site/' . $app->id . '#inquiry');
      } catch (Exception $e) {
        Log::debug('error: ' . $e->getMessage());
        DB::rollback_transaction();
        throw new Exception('failed to answer.');
      }
    }
    $this->template->content = View::forge('manage/inquiry', $data);
    return $this->template;
  }

  public function action_settings() {
    $user = Session::get('user');
    if (!$user) {
      Log::error('user not found.');
      return Response::forge(ViewModel::forge('public/login'), 200);
    }
    $data = array(
      'user' => $user
    );

    $this->template->content = View::forge('manage/settings', $data);
    return $this->template;
  }

  public function action_document() {
    $user = Session::get('user');
    $this->template->content = View::forge('manage/document', array());
    return $this->template;
  }

}
?>
