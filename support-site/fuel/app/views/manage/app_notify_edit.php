<link rel="stylesheet" type="text/css" href="/assets/css/themes/base/jquery.ui.all.css" />
<script type="text/javascript" src="/assets/js/ui/jquery-ui-1.8.17.custom.js"></script>
<script type="text/javascript" src="/assets/js/jquery.ui.datetimepicker.js"></script>
<script type="text/javascript" src="/assets/js/jquery.ui.datetimepicker-jp.js"></script>
<script type="text/javascript" src="/assets/js/manage/app_notify_edit.js"></script>
<h1>告知の追加</h1>
<p>告知情報を入力して、登録ボタンをクリックして下さい。</p>

<form action="/manage/add_notify_edit" method="post" class="form-horizontal">
  <input type="hidden" id="app_id" name="app_id" value="<?php echo $app->id; ?>" />
  <input type="hidden" id="id" name="id" value="<?php echo $notify->id; ?>" />
  <fieldset>
    <div class="control-group <?php if (isset($errors['name'])) { echo 'error'; } ?>">
      <label for="name" class="control-label">タイトル</label>
      <div class="controls">
        <input class="xlarge" id="name" name="name" size="30" type="text" value="<?php echo Input::post('name') ?>" />
<?php if (isset($errors['name'])) { ?>
        <span class="help-inline"><?php echo $errors['name'] ?></span>
<?php } ?>
      </div>
    </div><!-- /clearfix -->
    <div class="control-group <?php if (isset($errors['notify_at'])) { echo 'error'; } ?>">
      <label for="notify_at" class="control-label">通知予定日時</label>
      <div class="controls">
        <input class="xlarge" id="notify_at" name="notify_at" size="30" type="text" value="<?php echo Input::post('notify_at') ?>" />
<?php if (isset($errors['notify_at'])) { ?>
        <span class="help-inline"><?php echo $errors['notify_at'] ?></span>
<?php } ?>
        <div class="help">明日以降に設定することが可能です。</div>
      </div>
    </div><!-- /clearfix -->

  </fieldset>

  <div class="form-actions">
    <input type="submit" class="btn btn-primary" value="登録">&nbsp;<button type="reset" class="btn">キャンセル</button>
  </div>
</form>

