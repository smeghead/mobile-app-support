<link href="/assets/css/jquery.wysiwyg.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/assets/js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="/assets/js/controls/wysiwyg.link.js"></script>
<script type="text/javascript" src="/assets/js/controls/wysiwyg.image.js"></script>
<script type="text/javascript" src="/assets/js/controls/wysiwyg.table.js"></script>
<script type="text/javascript" src="/assets/js/manage/app_site.js"></script>
<h1>サポートサイト管理</h1>
<ul class="tabs">
  <li id="tabs_top"><a href="#top">サポートホーム</a></li>
  <li id="tabs_faq"><a href="#faq">FAQ管理</a></li>
  <li id="tabs_inquiry"><a href="#inquiry">問い合わせ管理</a></li>
</ul>

<input class="hide" id="id_input" type="hidden" value="<?php echo $app->id; ?>" />
<div id="alert-message-success" class="alert-message success hide" data-alert="">
  <a class="close" href="#">×</a>
  <p>更新しました。</p>
</div>
<div id="alert-message-error" class="alert-message error hide" data-alert="">
  <a class="close" href="#">×</a>
  <p>更新に失敗しました。<span id="error-description"></span></p>
</div>

<!-- ############## top ############## -->
<div id="tab_top">
  <p>サポートサイトのトップページを編集することができます。</p>

  <div class="row">
    <div class="span6" style="background-color: red;">
      <textarea class="xxlarge" id="top_content" name="top_content" rows="3"><?php echo Input::post('top_content') ?></textarea>
    </div>
    <div class="span6">
      <iframe src="/" id="top_content_preview"></iframe>
    </div>
  </div>
  <div class="actions">
    <input id="top_content_save" type="button" class="btn primary" value="登録">
  </div>
</div>

<!-- ############## faq ############## -->
<div id="tab_faq">
  <p>サポートサイトのFAQを管理することができます。</p>

  <div class="actions">
    <a class="save_faq btn primary">保存</a>
    <a class="btn open_add_category">新規カテゴリの追加</a>
    <a class="btn add-qa">新規QAの追加</a>
  </div>
  <div id="faqs" class="row">
    <div class="span6">
      <ul id="faq-categories span6">
      </ul>
    </div>
    <div class="span6">
      <form>
        <div id="form-category" class="qa-edit-form">
          <h4>カテゴリ名</h4>
          <input class="xlarge" id="category_name" name="category_name" size="20" type="text" value="" />
        </div>
        <div id="form-qa" class="qa-edit-form">
          <h4>質問</h4>
          <textarea class="xlarge" id="faq_q" name="top_content" rows="3"></textarea>
          <h4>回答</h4>
          <textarea class="xlarge" id="faq_a" name="top_content" rows="8"></textarea>
        </div>
      </form>
    </div>
  </div>
  <div class="actions">
    <a id="faq_save" class="save_faq btn primary">保存</a>
    <a class="btn" data-controls-modal="modal_add_qa_category" data-backdrop="false" data-keyboard="true">新規カテゴリの追加</a>
    <a class="btn add-qa">新規QAの追加</a>
  </div>
  <div id="modal_delete_confirm" class="modal hide fade">
    <div class="modal-header">
      <a href="#" class="close">×</a>
      <h3><span class="target"></span>の削除</h3>
    </div>
    <div class="modal-body">
      <p class="description"><span class="target"></span>を削除します。よろしいですか？</p>
    </div>
    <div class="modal-footer">
      <a id="btn_delete" class="btn danger delete_qa">削除</a>
      <a class="btn secondary qa_modal_close">閉じる</a>
    </div>
  </div>
  <div id="modal_add_qa_category" class="modal hide fade">
    <div class="modal-header">
      <a href="#" class="close">×</a>
      <h3>新規カテゴリの追加</h3>
    </div>
    <div class="modal-body">
      <p>追加するカテゴリ名を指定して下さい。</p>
      <form id="form_add_category">
        <input class="xlarge" id="new_category_name" name="email" size="30" type="text" value="" />
      </form>
    </div>
    <div class="modal-footer">
      <a id="btn_add_category" class="btn primary add_qa_category">追加</a>
      <a class="btn secondary qa_modal_close">閉じる</a>
    </div>
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
