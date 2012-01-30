<?php

class Controller_Api extends Controller_Rest {

  public function post_app($app_id) {
    Log::debug('post_app called.');
    $name = Input::post('name');
    $url = Input::post('url');
    $category = Input::post('category');

    $user = Session::get('user');
    $app = Model_App::find('first',
      array(
        'id' => $app_id,
        'user_id' => $user['id'],
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
    $app = Model_App::find('first',
      array(
        'id' => $app_id,
        'user_id' => $user['id'],
      )
    );
    if (!$app) {
      Log::error('app not found');
      return $this->response(array('error' => 'app not found'), 404);
    }

    $app_top_content = Model_Top_Content::find('first', array('app_id' => $app_id));
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
    $app = Model_App::find('first',
      array(
        'id' => $app_id,
        'user_id' => $user['id'],
      )
    );
    if (!$app) {
      Log::error('app not found');
      return $this->response(array('error' => 'app not found'), 404);
    }

    $app_top_content = Model_Top_Content::find('first', array('app_id' => $app_id));
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
}
