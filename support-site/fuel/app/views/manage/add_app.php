<script type="text/javascript" src="/assets/js/manage/add_app.js"></script>
<h1>アプリ追加</h1>
<p>追加するAndroidアプリ情報を入力して、登録ボタンをクリックして下さい。</p>

<form action="/manage/add_app" method="post">
  <fieldset>
    <div class="clearfix <?php if (isset($errors['name'])) { echo 'error'; } ?>">
      <label for="name">アプリ名</label>
      <div class="input">
        <input class="xlarge" id="name" name="name" size="30" type="text" value="<?php echo Input::post('name') ?>" />
<?php if (isset($errors['name'])) { ?>
        <span class="help-inline"><?php echo $errors['name'] ?></span>
<?php } ?>
      </div>
    </div><!-- /clearfix -->
    <div class="clearfix <?php if (isset($errors['url'])) { echo 'error'; } ?>">
      <label for="url">Android Market URL</label>
      <div class="input">
        <input class="xlarge" id="url" name="url" size="30" type="url" value="<?php echo Input::post('url') ?>" />
<?php if (isset($errors['url'])) { ?>
        <span class="help-inline"><?php echo $errors['url'] ?></span>
<?php } ?>
        <div class="help">例) https://market.android.com/details?id=com.example.app</div>
      </div>
    </div><!-- /clearfix -->
  </fieldset>

  <div class="actions">
    <input type="submit" class="btn primary" value="登録">&nbsp;<button type="reset" class="btn">キャンセル</button>
  </div>
</form>
