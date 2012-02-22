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
   * Support site.
   * 
   * @access  public
   * @return  Response
   */
  public function action_index($app_code = null) {
    Log::debug('app_code: ' . $app_code);
    if (!$app_code) {
      Log::error('app_code is required.');
      return Response::forge(ViewModel::forge('public/404'), 404);
    }
    $app = Model_App::find('first', array('where' => array(
          'code' => $app_code
        )
      )
    );
    if (!$app) {
      Log::error('no app.');
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
      'type' => Model_Access::$TYPE_SITE_ACCESS,
      'activity' => Input::get('activity'),
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

  public function action_notify($app_code, $notify_id) {
    Log::debug('app_code: ' . $app_code);
    Log::debug('notify_id: ' . $notify_id);
    if (!$app_code) {
      Log::error('app_code is required.');
      return Response::forge(ViewModel::forge('public/404'), 404);
    }
    $app = Model_App::find('first', array('where' => array(
          'code' => $app_code
        )
      )
    );
    if (!$app) {
      Log::error('no app.');
      return Response::forge(ViewModel::forge('public/404'), 404);
    }
    if (!$notify_id) {
      Log::error('notify_id is required.');
      return Response::forge(ViewModel::forge('public/404'), 404);
    }
    $notify = Model_Notify_Schedule::find('first', array('where' => array(
          'id' => $notify_id
        )
      )
    );
    if (!$notify) {
      Log::error('no notify.');
      return Response::forge(ViewModel::forge('public/404'), 404);
    }
    $messages = array_values($notify->notify_messages);
    $message = $messages[0];

    $remote_addr = Input::server('HTTP_X_FORWARDED_FOR');
    if (!$remote_addr) {
      Log::debug('no value HTTP_X_FORWARDED_FOR.');
      $remote_addr = Input::server('REMOTE_ADDR');
    }
    // record access
    $access = new Model_Access(array(
      'app_id' => $app->id,
      'terminal_id' => Util::get_terminal_id(),
      'type' => Model_Access::$TYPE_SITE_ACCESS_NOTIFY,
      'activity' => Input::get('activity'),
      'user_agent' => Input::user_agent(),
      'remote_addr' => $remote_addr
    ));
    $access->save();

    //notify log
    $notify_log = new Model_Notify_Log(array(
      'app_id' => $app->id,
      'notify_schedule_id' => $notify->id,
      'locale' => $message->locale,
      'terminal_id' => Util::get_terminal_id(),
      'notified_at' => time(),
    ));
    $notify_log->save();

    $data = array(
      'app' => $app,
      'notify' => $notify
    );
    Log::debug(var_export($data, true));
    // content の表示はHTMLを表示するため、auto_filter_outputをfalseにする
    \Config::set('security.auto_filter_output', false);
    return Response::forge(View::forge('mobile/notify', $data));
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
