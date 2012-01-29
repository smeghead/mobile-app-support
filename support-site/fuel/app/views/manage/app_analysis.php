<script type="text/javascript" src="/assets/js/manage/app_notify.js"></script>
<h1><?php echo $app->name; ?> 通知設定</h1>
<input class="hide" id="id_input" type="hidden" value="<?php echo $app->id; ?>" />
<div id="alert-message-success" class="alert-message success hide" data-alert="">
  <a class="close" href="#">×</a>
  <p>更新しました。</p>
</div>
<div id="alert-message-error" class="alert-message error hide" data-alert="">
  <a class="close" href="#">×</a>
  <p>更新に失敗しました。<span id="error-description"></span></p>
</div>
