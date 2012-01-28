<script type="text/javascript" src="/assets/js/manage/index.js"></script>
<h1>アプリ一覧</h1>
<div id="app_list">
<table>
  <tr>
    <th>アプリ名</th>
    <th>URL</th>
  </tr>
<?php foreach ($apps as $app) { ?>
  <tr>
    <td><a href="/manage/app/<?php echo $app['id'] ?>"><?php echo $app['name'] ?></a></td>
    <td><a href="/manage/app/<?php echo $app['id'] ?>"><?php echo $app['url'] ?></a></td>
  </tr>
<?php } ?>

</table>
</div>
<p><a href="/manage/add_app" class="btn primary">アプリを追加する&raquo;</a></p>
