<h1>ユーザ登録</h1>

<p>
  ユーザ情報を入力して、登録ボタンをクリックして下さい。
  既にユーザ登録が済んでいる場合は、<a href="/manage">ログイン</a>して下さい。
</p>

<form action="/public/register" method="post">
  <fieldset>
    <div class="control-group <?php if (isset($errors['user_id'])) { echo 'error'; } ?>">
      <label for="user_id" class="control-label">ユーザID</label>
      <div class="controls">
        <input class="xlarge" id="user_id" name="user_id" size="30" type="text" value="<?php echo Input::post('user_id') ?>" />
<?php if (isset($errors['user_id'])) { ?>
        <span class="help-inline"><?php echo $errors['user_id'] ?></span>
<?php } ?>
        <span>ご希望のユーザIDを入力して下さい。</span>
      </div>
    </div><!-- /clearfix -->
    <div class="control-group <?php if (isset($errors['passwd'])) { echo 'error'; } ?>">
      <label for="passwd" class="control-label">パスワード</label>
      <div class="controls">
        <input class="xlarge" id="passwd" name="passwd" size="30" type="password" value="<?php echo Input::post('passwd') ?>" />
<?php if (isset($errors['passwd'])) { ?>
        <span class="help-inline"><?php echo $errors['passwd'] ?></span>
<?php } ?>
      </div>
    </div><!-- /clearfix -->
    <div class="control-group <?php if (isset($errors['email'])) { echo 'error'; } ?>">
      <label for="email" class="control-label">メールアドレス</label>
      <div class="controls">
        <input class="xlarge" id="email" name="email" size="30" type="text" value="<?php echo Input::post('email') ?>" />
<?php if (isset($errors['email'])) { ?>
        <span class="help-inline"><?php echo $errors['email'] ?></span>
<?php } ?>
      </div>
    </div><!-- /clearfix -->
  </fieldset>

  <div class="form-actions">
    <input type="submit" class="btn btn-primary" value="登録">&nbsp;<button type="reset" class="btn">キャンセル</button>
  </div>
</form>
