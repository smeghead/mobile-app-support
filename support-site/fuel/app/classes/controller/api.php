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
}
