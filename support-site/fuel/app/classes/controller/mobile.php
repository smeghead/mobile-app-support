<?php

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 * 
 * @package  app
 * @extends  Controller
 */
class Controller_Mobile extends Controller {

  /**
   * The basic welcome message
   * 
   * @access  public
   * @return  Response
   */
  public function action_index($app_code = null) {
    Log::debug('app_code: ' . $app_code);
    if (!$app_code) {
      return Response::forge(ViewModel::forge('public/404'), 404);
    }
    $app = Model_App::find('first', array('where' => array(
          'code' => $app_code
        )
      )
    );
    if (!$app) {
      return Response::forge(ViewModel::forge('public/404'), 404);
    }

    $remote_addr = Input::server('HTTP_X_FORWARDED_FOR');
    if (!$remote_addr) {
      Log::debug('no value HTTP_X_FORWARDED_FOR.');
      $remote_addr = Input::server('REMOTE_ADDR');
    }
    // record access
    $access = new Model_Access(array(
      'app_id' => $app->id,
      'terminal_id' => Util::get_terminal_id(),
      'type' => 1,
      'user_agent' => Input::user_agent(),
      'remote_addr' => $remote_addr
    ));
    $access->save();

    $top_content = Model_Top_Content::find('first', array('where' => array(
          'app_id' => $app->id
        )
      )
    );
    $content = '';
    if ($top_content) {
      $content = $top_content->content;
    }
    $data = array(
      'app' => $app,
      'content' => $content
    );
    Log::debug(var_export($data, true));
    // content の表示はHTMLを表示するため、auto_filter_outputをfalseにする
    \Config::set('security.auto_filter_output', false);
    return Response::forge(View::forge('mobile/index', $data));
  }

  /**
   * The 404 action for the application.
   * 
   * @access  public
   * @return  Response
   */
  public function action_404() {
    return Response::forge(ViewModel::forge('mobile/404'), 404);
  }
}
