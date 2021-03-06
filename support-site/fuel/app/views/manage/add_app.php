<script type="text/javascript" src="/assets/js/manage/add_app.js"></script>
<h1>アプリ追加</h1>
<p>追加するAndroidアプリ情報を入力して、登録ボタンをクリックして下さい。</p>

<form action="/manage/add_app" method="post" class="form-horizontal">
  <fieldset>
    <div class="control-group <?php if (isset($errors['name'])) { echo 'error'; } ?>">
      <label for="name" class="control-label">アプリ名</label>
      <div class="controls">
        <input class="xlarge" id="name" name="name" size="30" type="text" value="<?php echo Input::post('name') ?>" />
<?php if (isset($errors['name'])) { ?>
        <span class="help-inline"><?php echo $errors['name'] ?></span>
<?php } ?>
      </div>
    </div><!-- /clearfix -->
    <div class="control-group <?php if (isset($errors['url'])) { echo 'error'; } ?>">
      <label for="url" class="control-label">Android Market URL</label>
      <div class="controls">
        <input class="xlarge" id="url" name="url" size="30" type="url" value="<?php echo Input::post('url') ?>" />
<?php if (isset($errors['url'])) { ?>
        <span class="help-inline"><?php echo $errors['url'] ?></span>
<?php } ?>
        <div class="help">例) https://market.android.com/details?id=com.example.app</div>
      </div>
    </div><!-- /clearfix -->
    <div class="control-group <?php if (isset($errors['package_name'])) { echo 'error'; } ?>">
      <label for="package_name" class="control-label">パッケージ名</label>
      <div class="controls">
        <input class="xlarge" id="package_name" name="package_name" size="30" type="text" value="<?php echo Input::post('package_name') ?>" />
<?php if (isset($errors['package_name'])) { ?>
        <span class="help-inline"><?php echo $errors['package_name'] ?></span>
<?php } ?>
        <div class="help">例) com.example.app</div>
      </div>
    </div><!-- /clearfix -->
    <div class="control-group <?php if (isset($errors['category'])) { echo 'error'; } ?>">
      <label for="category" class="control-label">カテゴリ</label>
      <div class="controls">
        <select id="category" name="category">
          <option value="">選択してください。</option>
<?php foreach ($app_categories as $category) { ?>
          <option value="<?php echo $category->category_code; ?>" <?php if ($category->category_code == Input::post('category')) {echo 'selected="selected"';} ?>><?php echo $category->name; ?></option>
<?php } ?>
        </select>
<?php if (isset($errors['category'])) { ?>
        <span class="help-inline"><?php echo $errors['category'] ?></span>
<?php } ?>
      </div>
    </div><!-- /clearfix -->

  </fieldset>

  <div class="form-actions">
    <input type="submit" class="btn btn-primary" value="登録">&nbsp;<a href="/manage/index" class="btn">キャンセル</a>
  </div>
</form>
