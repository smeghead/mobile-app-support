<h1>ユーザ登録</h1>

<p>
  ユーザ情報を入力して、登録ボタンをクリックして下さい。
  既にユーザ登録が済んでいる場合は、<a href="/manage">ログイン</a>して下さい。
</p>

<form action="/public/register" method="post">
  <fieldset>
    <div class="clearfix <?php if (isset($errors['user_id'])) { echo 'error'; } ?>">
      <label for="user_id">ユーザID</label>
      <div class="input">
        <input class="xlarge" id="user_id" name="user_id" size="30" type="text" value="<?php echo Input::post('user_id') ?>" />
<?php if (isset($errors['user_id'])) { ?>
        <span class="help-inline"><?php echo $errors['user_id'] ?></span>
<?php } ?>
        <span>ご希望のユーザIDを入力して下さい。</span>
      </div>
    </div><!-- /clearfix -->
    <div class="clearfix <?php if (isset($errors['passwd'])) { echo 'error'; } ?>">
      <label for="passwd">パスワード</label>
      <div class="input">
        <input class="xlarge" id="passwd" name="passwd" size="30" type="password" value="<?php echo Input::post('passwd') ?>" />
<?php if (isset($errors['passwd'])) { ?>
        <span class="help-inline"><?php echo $errors['passwd'] ?></span>
<?php } ?>
      </div>
    </div><!-- /clearfix -->
    <div class="clearfix <?php if (isset($errors['email'])) { echo 'error'; } ?>">
      <label for="email">メールアドレス</label>
      <div class="input">
        <input class="xlarge" id="email" name="email" size="30" type="text" value="<?php echo Input::post('email') ?>" />
<?php if (isset($errors['email'])) { ?>
        <span class="help-inline"><?php echo $errors['email'] ?></span>
<?php } ?>
      </div>
    </div><!-- /clearfix -->
  </fieldset>

  <div class="actions">
    <input type="submit" class="btn primary" value="登録">&nbsp;<button type="reset" class="btn">キャンセル</button>
  </div>
</form>
