<script type="text/javascript" src="/assets/js/manage/index.js"></script>
<h1><?php echo $app->name; ?></h1>
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
