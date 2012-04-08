<script type="text/javascript" src="/assets/js/manage/index.js"></script>
<ul class="breadcrumb">
  <li class="active">
    <a href="/manage/">アプリ一覧</a> <span class="divider">/</span>
  </li>
</ul>
<h1>アプリ一覧</h1>
<?php if (count($apps) > 0) { ?>
<div id="app_list">
<table class="table">
  <tr>
    <th>アプリ名</th>
    <th>URL</th>
    <th>ユーザサポート編集</th>
    <th>問い合わせ件数</th>
  </tr>
<?php foreach ($apps as $app) { ?>
  <tr>
    <td class="block-link"><a href="/manage/app/<?php echo $app['id'] ?>"><?php echo $app['name'] ?></a></td>
    <td class="block-link"><a href="/manage/app/<?php echo $app['id'] ?>"><?php echo $app['url'] ?></a></td>
    <td><a href="/manage/app_site/<?php echo $app['id'] ?>" class="btn">編集</a></td>
<?php
$inquiries = array_values($app->inquiry_bases);
$not_answered = 0;
foreach ($inquiries as $i) {
  if ($i->status == 1) $not_answered++;
}
?>
  <td class="block-link<?php if ($not_answered > 0) {echo ' exists-inquiry';} ?>">
  <a href="/manage/app_site/<?php echo $app['id'] ?>#inquiry"><?php echo $not_answered; ?>(<?php echo count($inquiries); ?>)</a>
    </td>
  </tr>
<?php } ?>

</table>
</div>
<?php } else { ?>
<div id="introduction">
  <p>ユーザ登録ありがとうございます。</p>
  <p>
    まず最初に、下のボタンからアプリを登録して下さい。
    その後の作業については、<a href="/manage/document" target="_blank">ドキュメント</a>を参考にして下さい。
  </p>
  <p>
    ドキュメントは、いつでも左のメニューから参照できます。
  </p>
</div>
<?php } ?>
<p><a href="/manage/add_app" class="btn btn-primary">アプリを追加する&raquo;</a></p>
