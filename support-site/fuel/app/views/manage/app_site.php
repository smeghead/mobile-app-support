<link href="/assets/css/jquery.wysiwyg.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/assets/js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="/assets/js/manage/app_site.js"></script>
<h1>サポートサイト管理</h1>
<ul class="tabs">
  <li id="tabs_top"><a href="#top">サポートホーム</a></li>
  <li id="tabs_faq"><a href="#faq">FAQ管理</a></li>
  <li id="tabs_inquiry"><a href="#inquiry">問い合わせ管理</a></li>
</ul>

<!-- ############## top ############## -->
<div id="tab_top">
  <form>
    <p>サポートサイトのトップページを編集することができます。</p>

    <fieldset>
      <div class="clearfix <?php if (isset($errors['top_content'])) { echo 'error'; } ?>">
        <label for="top_content">コンテンツ</label>
        <div class="input">
          <textarea class="xxlarge" id="top_content" name="top_content" rows="3"><?php echo Input::post('top_content') ?></textarea>
  <?php if (isset($errors['top_content'])) { ?>
          <span class="help-inline"><?php echo $errors['top_content'] ?></span>
  <?php } ?>
        </div>
      </div><!-- /clearfix -->
    </fieldset>
    <div class="actions">
      <input type="submit" class="btn primary" value="登録">
    </div>
  </form>
</div>

<!-- ############## faq ############## -->
<div id="tab_faq">
  <p>サポートサイトのFAQを管理することができます。</p>

  <div class="actions">
    <a class="save_faq btn primary">保存</a>
    <a class="add_category btn">新規カテゴリの追加</a>
  </div>
  <div id="faqs" class="row">
    <div class="span6">
      <ul id="faq-categories span6">
        <li class="faq-category" data-id="1">
          アプリの動作
          <span class="right qa-delete">&nbsp;</span>
          <span class="right qa-edit">&nbsp;</span>
          <br class="close"/>
        </li>
        <li class="faq-element" data-id="2">
          アプリが起動しない
          <span class="right qa-delete">&nbsp;</span>
          <span class="right qa-edit">&nbsp;</span>
          <br class="close"/>
        </li>
        <li class="faq-element" data-id="3">
          新着通知時に音がうるさい
          <span class="right qa-delete">&nbsp;</span>
          <span class="right qa-edit">&nbsp;</span>
          <br class="close"/>
        </li>
        <li class="faq-element" data-id="4">
          バッテリーを節約したい
          <span class="right qa-delete">&nbsp;</span>
          <span class="right qa-edit">&nbsp;</span>
          <br class="close"/>
        </li>
        <li class="faq-category" data-id="5">
          その他
          <span class="right qa-delete">&nbsp;</span>
          <span class="right qa-edit">&nbsp;</span>
          <br class="close"/>
        </li>
        <li class="faq-element" data-id="6">
          無料ですか？
          <span class="right qa-delete">&nbsp;</span>
          <span class="right qa-edit">&nbsp;</span>
          <br class="close"/>
        </li>
      </ul>
    </div>
    <div class="span6">
<form>
  <h4>質問</h4>
          <textarea class="xlarge" id="faq_q" name="top_content" rows="3"><?php echo Input::post('top_content') ?></textarea>
  <h4>回答</h4>
          <textarea class="xlarge" id="faq_a" name="top_content" rows="8"><?php echo Input::post('top_content') ?></textarea>
</form>
    </div>
  </div>
  <div class="actions">
    <a class="save_faq btn primary">保存</a>
    <a class="add_category btn">新規カテゴリの追加</a>
  </div>
</div>

<!-- ############## inquiry ############## -->
<div id="tab_inquiry">
  <p>サポートサイトの問い合わせを管理します。</p>

  <table>
    <tr>
      <th>問い合わせ日時</th>
      <th>状態</th>
      <th>質問者</th>
      <th>内容</th>
      <th>回答日時</th>
    </tr>
    <tr>
      <td>2012-01-01 00:00:00</td>
      <td>回答済</td>
      <td>hogehoge@hoge.com</td>
      <td>こわれました。なぜかわからないけど。。。</td>
      <td>2011-01-03 00:00:00</td>
    </tr>
    <tr>
      <td>2012-01-01 00:00:00</td>
      <td>未回答</td>
      <td>hogehoge@hoge.com</td>
      <td>またこわれました。なぜかわからない。。。</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>

        <footer>
          <p>&copy; smeghead 2011</p>
        </footer>
