<link href="/assets/css/jquery.wysiwyg.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/assets/js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="/assets/js/controls/wysiwyg.link.js"></script>
<script type="text/javascript" src="/assets/js/controls/wysiwyg.image.js"></script>
<script type="text/javascript" src="/assets/js/controls/wysiwyg.table.js"></script>
<script type="text/javascript" src="/assets/js/manage/app_site.js"></script>
<ul class="breadcrumb">
  <li>
    <a href="/manage/">アプリ一覧</a> <span class="divider">/</span>
  </li>
  <li>
    <a href="/manage/app/<?php echo $app->id; ?>"><?php echo $app->name; ?></a> <span class="divider">/</span>
  </li>
  <li class="active">
    <a href="">サポート機能管理</a>
  </li>
</ul>
<h1>サポート機能管理</h1>
<ul class="nav nav-tabs">
  <li id="tabs_top"><a href="#top">サポートホーム</a></li>
  <li id="tabs_faq"><a href="#faq">FAQ管理</a></li>
  <li id="tabs_inquiry"><a href="#inquiry">問い合わせ管理</a></li>
</ul>

<input class="hide" id="id_input" type="hidden" value="<?php echo $app->id; ?>" />
<div id="alert-message-success" class="alert hide" data-alert="">
  <a class="close" data-dismiss="alert" href="#">&times;</a>
  <p>更新しました。</p>
</div>
<div id="alert-message-error" class="alert error hide" data-alert="">
  <a class="close" data-dismiss="alert" href="#">&times;</a>
  <p>更新に失敗しました。<span id="error-description"></span></p>
</div>

<!-- ############## top ############## -->
<div id="tab_top">
  <p>サポートのトップページを編集することができます。</p>

  <div class="row-fluid">
    <div class="span6">
      <textarea class="xxlarge" id="top_content" name="top_content" rows="3"><?php echo Input::post('top_content') ?></textarea>
    </div>
    <div class="span6">
      <iframe src="/mobile/index/<?php echo $app->code; ?>" id="top_content_preview"></iframe>
    </div>
  </div>
  <div class="form-actions">
    <input id="top_content_save" type="button" class="btn btn-primary" value="登録">
  </div>
</div>

<!-- ############## faq ############## -->
<div id="tab_faq">
  <p>サポートのFAQを管理することができます。</p>

  <div class="form-actions">
    <a class="save_faq btn btn-primary">保存</a>
    <a class="btn open_add_category">新規カテゴリの追加</a>
    <a class="btn add-qa">新規QAの追加</a>
  </div>
  <div id="faqs" class="row-fluid">
    <div class="span6">
      <ul id="faq-categories span6">
      </ul>
    </div>
    <div class="span6">
      <form class="form-horizontal">
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
  <div class="form-actions">
    <a id="faq_save" class="save_faq btn btn-primary">保存</a>
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
      <a id="btn_add_category" class="btn btn-primary add_qa_category">追加</a>
      <a class="btn secondary qa_modal_close">閉じる</a>
    </div>
  </div>
</div>

<!-- ############## inquiry ############## -->
<div id="tab_inquiry">
  <p>サポートの問い合わせ履歴です。</p>

  <table class="table">
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
