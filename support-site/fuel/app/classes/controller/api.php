<?php

class Controller_Api extends Controller_Rest {

  public function post_app($app_id) {
    Log::debug('post_app called.');
    $name = Input::post('name');
    $url = Input::post('url');
    $category = Input::post('category');

    $user = Session::get('user');
    $app = Model_App::find('first', array('where' => array(
          'id' => $app_id,
          'user_id' => $user['id'],
        )
      )
    );
    if (!$app) {
      Log::error('app not found');
      return $this->response(array('error' => 'app not found'), 404);
    }

    $app->name = $name;
    $app->url = $url;
//    $app->category = $category;
    $app->save();
    Log::debug('app updated.');
    return $this->response(array(
      'app' => $app->to_array(),
      'error' => null
    ));
  }

  public function get_app_top_content($app_id) {
    Log::debug('post_app_top_content called.');
    $content = Input::post('content');

    $user = Session::get('user');
    $app = Model_App::find('first', array(
        'where' => array(
          'id' => $app_id,
          'user_id' => $user['id'],
        )
      )
    );
    if (!$app) {
      Log::error('app not found');
      return $this->response(array('error' => 'app not found'), 404);
    }

    $app_top_content = Model_Top_Content::find('first', array('where' => array('app_id' => $app_id)));
    if (!$app_top_content) {
      Log::error('app_top_content not found');
      return $this->response(array('app_top_content' => array('content' => '<h1>' . $app->name . '</h1>')));
    }
    return $this->response(array(
      'app_top_content' => $app_top_content->to_array(),
      'error' => null
    ));
  }

  public function post_app_top_content($app_id) {
    Log::debug('post_app_top_content called.');
    $content = Input::post('content');

    $user = Session::get('user');
    $app = Model_App::find('first', array(
        'where' => array(
          'id' => $app_id,
          'user_id' => $user['id'],
        )
      )
    );
    if (!$app) {
      Log::error('app not found');
      return $this->response(array('error' => 'app not found'), 404);
    }

    $app_top_content = Model_Top_Content::find('first', array('where' => array('app_id' => $app_id)));
    if (!$app_top_content) {
      $app_top_content = new Model_Top_Content();
      $app_top_content->app_id = $app_id;
      $app_top_content->enabled = 1;
    }
    $app_top_content->content = $content;
    $app_top_content->save();
    Log::debug('app_top_content updated.');
    return $this->response(array(
      'app_top_content' => $app_top_content->to_array(),
      'error' => null
    ));
  }

  public function get_faq($app_id = 0) {
    Log::debug('get_faq called.');
    $code = Input::get('code');
    if ($code) {
      $app = Model_App::find('first', array('where' => array('code' => $code)));
    } else {
      $user = Session::get('user');
      $app = Model_App::find('first', array('where' => array(
            'id' => $app_id,
            'user_id' => $user['id'],
          )
        )
      );
    }
    Log::debug(var_export($app, true));
    if (!$app) {
      Log::error('app not found');
      return $this->response(array('error' => 'app not found'), 404);
    }

    $faqs = array();
    $categories = DB::select()->from('faq_categories')->where('app_id', $app->id)->execute();
    foreach ($categories as $category) {
      $faqs[] = array(
        'type' => 'category',
        'id' => 'category' . $category['id'],
        'name' => $category['name']
      );
      $questions = DB::select()->from('faq_questions')->where('app_id', $app->id)->where('category_id', $category['id'])->execute();
      foreach ($questions as $q) {
        $faqs[] = array(
          'type' => 'question',
          'id' => 'qa' . $q['id'],
          'question' => $q['question'],
          'answer' => $q['answer']
        );
      }
    }
    $this->response(array('faqs' => $faqs));
  }

  public function post_faq($app_id) {
    Log::debug('post_faq called.');
    Log::debug(Input::post('json'));
    $faqs = json_decode(Input::post('json'), true);
    if ($faqs == NULL) {
      Log::error('failed to retrieve parameter. err_code: ' . json_last_error());
      $this->response(array('error' => 'failed to retrieve parameter. err_code: ' . json_last_error()), 500);
    }
    Log::debug(var_export($faqs, true));

    $user = Session::get('user');
    $app = Model_App::find('first', array('where' => array(
          'id' => $app_id,
          'user_id' => $user['id'],
        )
      )
    );
    if (!$app) {
      Log::error('app not found');
      return $this->response(array('error' => 'app not found'), 404);
    }

    DB::start_transaction();
    try {
      DB::delete('faq_categories')->where('app_id', $app_id)->execute();
      DB::delete('faq_questions')->where('app_id', $app_id)->execute();

      $last_category_id;
      foreach ($faqs as $elem) {
        if ($elem['type'] == 'category') {
          list($last_category_id, $affect_rows) = DB::insert('faq_categories')->set(array(
            'app_id' => $elem['app_id'],
            'name' => $elem['name']
          ))->execute();
          Log::debug('last_inserted_id:::::' . $last_category_id);
        } else {
          DB::insert('faq_questions')->set(array(
            'app_id' => $elem['app_id'],
            'category_id' => $last_category_id,
            'question' => $elem['question'],
            'answer' => $elem['answer']
          ))->execute();
        }
      }
      DB::commit_transaction();
      return $this->response(array(
        'error' => null
      ));
    } catch (Exception $e) {
      Log::debug('error: ' + $e->getMessage());
      DB::rollback_transaction();
      return $this->response(array(
        'error' => $e->getMessage()
      ), 500);
    }
  }

  public function post_inquiry($code) {
    Log::debug('post_inquiry called.');
    Log::debug($code);
    Log::debug(Input::post('email'));
    Log::debug(Input::post('question'));
    $email = Input::post('email');
    $question = Input::post('question');

    if (!$code) {
      Log::error('code empty.');
      return $this->response(array('error' => ' 不正なパラメータです。'), 500);
    }
    if (!$email) {
      Log::error('email empty.');
      return $this->response(array('error' => 'メールアドレスを入力して下さい。'), 500);
    }
    if (!$question) {
      Log::error('question empty.');
      return $this->response(array('error' => '内容を入力して下さい。'), 500);
    }

    $app = Model_App::find('first', array('where' => array(
          'code' => $code
        )
      )
    );
    if (!$app) {
      Log::error('app not found');
      return $this->response(array('error' => 'app not found'), 404);
    }

    DB::start_transaction();
    try {
      $inquiry_base = new Model_Inquiry_Base(array(
        'app_id' => $app->id,
        'status' => 1,
        'content' => $question,
        'answered_at' => 0,
        'asked_at' => time()
      ));
      $inquiry_base->inquiry_messages[] = new Model_Inquiry_Message(array(
        'email' => $email,
        'content' => $question
      ));
      $inquiry_base->save();
      DB::commit_transaction();
      return $this->response(array(
        'error' => null
      ));
    } catch (Exception $e) {
      Log::debug('error: ' + $e->getMessage());
      DB::rollback_transaction();
      return $this->response(array(
        'error' => $e->getMessage()
      ), 500);
    }
  }
}
