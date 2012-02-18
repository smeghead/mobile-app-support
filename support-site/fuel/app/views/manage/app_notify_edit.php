<link href="/assets/css/jquery.wysiwyg.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/assets/css/themes/base/jquery.ui.all.css" />
<h1>告知の追加</h1>
<p>告知情報を入力して、登録ボタンをクリックして下さい。</p>

<form action="/manage/app_notify_edit/<?php echo $app->id; ?>/<?php echo $notify->id; ?>" method="post" class="form-horizontal">
  <input type="hidden" id="app_id" name="app_id" value="<?php echo $app->id; ?>" />
  <input type="hidden" id="id" name="id" value="<?php echo $notify->id; ?>" />
  <fieldset>
<?php $messages = array_values($notify->notify_messages); ?>
    <div class="control-group <?php if (isset($errors['locale'])) { echo 'error'; } ?>">
      <label for="locale" class="control-label">ロケール</label>
      <div class="controls">
        <input class="xlarge" id="locale" name="locale" size="30" type="text" value="<?php if (Input::method() == 'GET') {echo $messages[0]->locale; } else {echo Input::post('locale'); } ?>" />
<?php if (isset($errors['locale'])) { ?>
        <span class="help-inline"><?php echo $errors['locale'] ?></span>
<?php } ?>
        <div class="help">例) en ja など。ロケールを指定しない場合は、空欄のままにして下さい。</div>
      </div>
    </div><!-- /clearfix -->
    <div class="control-group <?php if (isset($errors['subject'])) { echo 'error'; } ?>">
      <label for="subject" class="control-label">タイトル</label>
      <div class="controls">
        <input class="xlarge" id="subject" name="subject" size="30" type="text" value="<?php if (Input::method() == 'GET') {echo $messages[0]->subject; } else {echo Input::post('subject'); } ?>" />
<?php if (isset($errors['subject'])) { ?>
        <span class="help-inline"><?php echo $errors['subject'] ?></span>
<?php } ?>
      </div>
    </div><!-- /clearfix -->
    <div class="control-group <?php if (isset($errors['notify_at'])) { echo 'error'; } ?>">
      <label for="notify_at" class="control-label">告知予定日時</label>
      <div class="controls">
        <input class="xlarge" id="notify_at" name="notify_at" size="30" type="text" value="<?php if (Input::method() == 'GET') {echo date('Y-m-d H:i:s', $notify->notify_at); } else {echo Input::post('notify_at'); } ?>" />
<?php if (isset($errors['notify_at'])) { ?>
        <span class="help-inline"><?php echo $errors['notify_at'] ?></span>
<?php } ?>
        <div class="help">24時間後以降に設定することが可能です。</div>
      </div>
    </div><!-- /clearfix -->
    <div class="control-group <?php if (isset($errors['content'])) { echo 'error'; } ?>">
      <label for="content" class="control-label">告知内容</label>
      <div class="controls">
        <textarea class="xxlarge" id="content" name="content" rows="3"><?php if (Input::method() == 'GET') {echo $messages[0]->content; } else {echo Input::post('content'); } ?></textarea>
<?php if (isset($errors['content'])) { ?>
        <span class="help-inline"><?php echo $errors['content'] ?></span>
<?php } ?>
      </div>
    </div><!-- /clearfix -->
    <div class="control-group <?php if (isset($errors['activity'])) { echo 'error'; } ?>">
      <label for="activity" class="control-label">移動先Activity</label>
      <div class="controls">
        <input class="xlarge" id="activity" name="activity" size="30" type="text" value="<?php if (Input::method() == 'GET') {echo $messages[0]->activity; } else {echo Input::post('activity'); } ?>" />
<?php if (isset($errors['activity'])) { ?>
        <span class="help-inline"><?php echo $errors['activity'] ?></span>
<?php } ?>
      </div>
    </div><!-- /clearfix -->

  </fieldset>

  <div class="form-actions">
    <input type="submit" class="btn btn-primary" value="登録">&nbsp;<a href="/manage/app_notify/<?php echo $app->id; ?>" class="btn">キャンセル</a></button>
  </div>
</form>

<script type="text/javascript" src="/assets/js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="/assets/js/controls/wysiwyg.link.js"></script>
<script type="text/javascript" src="/assets/js/controls/wysiwyg.image.js"></script>
<script type="text/javascript" src="/assets/js/controls/wysiwyg.table.js"></script>
<script type="text/javascript" src="/assets/js/ui/jquery-ui-1.8.17.custom.js"></script>
<script type="text/javascript" src="/assets/js/jquery.ui.datetimepicker.js"></script>
<script type="text/javascript" src="/assets/js/jquery.ui.datetimepicker-jp.js"></script>
<script type="text/javascript" src="/assets/js/manage/app_notify_edit.js"></script>
