<script type="text/javascript" src="/assets/js/manage/app.js"></script>
<h1><?php echo $app->name; ?></h1>
<input class="hide" id="id_input" type="hidden" value="<?php echo $app->id; ?>" />
<div id="alert-message-success" class="alert-message success hide" data-alert="">
  <a class="close" href="#">×</a>
  <p>更新しました。</p>
</div>
<div id="alert-message-error" class="alert-message error hide" data-alert="">
  <a class="close" href="#">×</a>
  <p>更新に失敗しました。<span id="error-description"></span></p>
  
</div>
<table class="span12">
  <tr>
    <th>アプリ名</th>
    <td>
      <input class="xlarge hide" id="app_name_input" size="20" type="text" value="" />
      <span id="app_name" class="text"><?php echo $app->name; ?></span>
      <span class="right name-edit edit-icon" title="編集">&nbsp;</span>
    </td>
  </tr>
  <tr>
    <th>マーケットURL</th>
    <td>
      <input class="xlarge hide" id="url_input" size="20" type="text" value="" />
      <span id="url" class="text"><?php echo $app->url; ?></span>
      <span class="right url-edit edit-icon" title="編集">&nbsp;</span>
    </td>
  </tr>
  <tr>
    <th>カテゴリ</th>
    <td>
      <select id="category_input" class="hide">
        <option value=""></option>
        <option value=""></option>
        <option value=""></option>
        <option value=""></option>
        <option value=""></option>
        <option value=""></option>
        <option value=""></option>
        <option value=""></option>
        <option value=""></option>
        <option value=""></option>
      </select>
      <span id="category" class="text"></span>
      <span class="right category-edit edit-icon" title="編集">&nbsp;</span>
    </td>
  </tr>
</table>
<div class="row banner-menu">
  <div class="span3">
    <h4><a href="/manage/app_site/<?php echo $app->id; ?>">サポートサイト管理</a></h4>
    <div><a href="/manage/app_site/<?php echo $app->id; ?>"><img src="/assets/img/manage-banner.png" alt="サポートサイト管理" /></a></div>
  </div>
  <div class="span3">
    <h4><a href="/manage/app_notify/<?php echo $app->id; ?>">ステータス通知</a></h4>
    <div><a href="/manage/app_notify/<?php echo $app->id; ?>"><img src="/assets/img/notify-banner.png" alt="ステータス通知" /></a></div>
  </div>
  <div class="span3">
    <h4><a href="/manage/app_analysis/<?php echo $app->id; ?>">統計情報</a></h4>
    <div><a href="/manage/app_analysis/<?php echo $app->id; ?>"><img src="/assets/img/analysis-banner.png" alt="統計情報" /></a></div>
  </div>
</div>
