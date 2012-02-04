<script type="text/javascript" src="/assets/js/manage/index.js"></script>
<h1>アプリ一覧</h1>
<div id="app_list">
<table class="table">
  <tr>
    <th>アプリ名</th>
    <th>URL</th>
    <th>サポートサイト編集</th>
    <th>問い合わせ件数</th>
  </tr>
<?php foreach ($apps as $app) { ?>
  <tr>
    <td class="block-link"><a href="/manage/app/<?php echo $app['id'] ?>"><?php echo $app['name'] ?></a></td>
    <td class="block-link"><a href="/manage/app/<?php echo $app['id'] ?>"><?php echo $app['url'] ?></a></td>
    <td><a href="/manage/app_site/<?php echo $app['id'] ?>" class="btn">編集</a></td>
    <td class="block-link"><a href="/manage/app_site/<?php echo $app['id'] ?>#inquiry">3(10)</a></td>
  </tr>
<?php } ?>

</table>
</div>
<p><a href="/manage/add_app" class="btn btn-primary">アプリを追加する&raquo;</a></p>
