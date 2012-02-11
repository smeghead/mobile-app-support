<script type="text/javascript" src="/assets/js/manage/app_analysis.js"></script>
<ul class="breadcrumb">
  <li>
    <a href="/manage/">アプリ一覧</a> <span class="divider">/</span>
  </li>
  <li>
    <a href="/manage/app/<?php echo $app->id; ?>"><?php echo $app->name; ?></a> <span class="divider">/</span>
  </li>
  <li class="active">
    <a href="">告知設定</a>
  </li>
</ul>
<h1>告知設定</h1>
<input class="hide" id="id_input" type="hidden" value="<?php echo $app->id; ?>" />
<div id="alert-message-success" class="alert-message success hide" data-alert="">
  <a class="close" href="#">×</a>
  <p>更新しました。</p>
</div>
<div id="alert-message-error" class="alert-message error hide" data-alert="">
  <a class="close" href="#">×</a>
  <p>更新に失敗しました。<span id="error-description"></span></p>
</div>
