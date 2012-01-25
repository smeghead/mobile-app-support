<script type="text/javascript" src="/assets/js/manage/app_site.js"></script>
<h1>サポートサイト管理</h1>
<ul class="tabs">
  <li id="tabs_top"><a href="#top">サポートホーム</a></li>
  <li id="tabs_faq"><a href="#faq">FAQ管理</a></li>
  <li id="tabs_inquiry"><a href="#inquiry">問い合わせ管理</a></li>
</ul>

<form>
  <!-- ############## top ############## -->
  <div id="top">
    <p>サポートサイトのトップページを編集することができます。</p>

    <fieldset>
      <div class="clearfix <?php if (isset($errors['name'])) { echo 'error'; } ?>">
        <label for="name">コンテンツ</label>
        <div class="input">
          <textarea class="xxlarge" id="name" name="name" rows="3"><?php echo Input::post('name') ?></textarea>
  <?php if (isset($errors['name'])) { ?>
          <span class="help-inline"><?php echo $errors['name'] ?></span>
  <?php } ?>
        </div>
      </div><!-- /clearfix -->
    </fieldset>
  </div>

  <!-- ############## faq ############## -->
  <div id="faq">
    <p>サポートサイトのFAQを管理することができます。</p>

    <fieldset>
      <div class="clearfix <?php if (isset($errors['name'])) { echo 'error'; } ?>">
        <label for="name">コンテンツ</label>
        <div class="input">
          <textarea class="xxlarge" id="name" name="name" rows="3"><?php echo Input::post('name') ?></textarea>
  <?php if (isset($errors['name'])) { ?>
          <span class="help-inline"><?php echo $errors['name'] ?></span>
  <?php } ?>
        </div>
      </div><!-- /clearfix -->
    </fieldset>
  </div>

  <!-- ############## inquiry ############## -->
  <div id="inquiry">
    <p>サポートサイトの問い合わせを管理します。</p>

    <fieldset>
      <div class="clearfix <?php if (isset($errors['name'])) { echo 'error'; } ?>">
        <label for="name">コンテンツ</label>
        <div class="input">
          <textarea class="xxlarge" id="name" name="name" rows="3"><?php echo Input::post('name') ?></textarea>
  <?php if (isset($errors['name'])) { ?>
          <span class="help-inline"><?php echo $errors['name'] ?></span>
  <?php } ?>
        </div>
      </div><!-- /clearfix -->
    </fieldset>
  </div>

  <div class="actions">
    <input type="submit" class="btn primary" value="登録">
  </div>
</form>
        <footer>
          <p>&copy; smeghead 2011</p>
        </footer>
