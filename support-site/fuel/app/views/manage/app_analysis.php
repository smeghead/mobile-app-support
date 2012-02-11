<link rel="stylesheet" type="text/css" href="/assets/js/visualize/css/visualize.css" />
<script type="text/javascript" src="/assets/js/manage/app_analysis.js"></script>
<script type="text/javascript" src="/assets/js/visualize/js/visualize.jQuery.js"></script>

<ul class="breadcrumb">
  <li>
    <a href="/manage/">アプリ一覧</a> <span class="divider">/</span>
  </li>
  <li>
    <a href="/manage/app/<?php echo $app->id; ?>"><?php echo $app->name; ?></a> <span class="divider">/</span>
  </li>
  <li class="active">
    <a href="">統計情報</a>
  </li>
</ul>
<h1>統計情報</h1>
<input class="hide" id="id_input" type="hidden" value="<?php echo $app->id; ?>" />
<div id="alert-message-success" class="alert-message success hide" data-alert="">
  <a class="close" href="#">×</a>
  <p>更新しました。</p>
</div>
<div id="alert-message-error" class="alert-message error hide" data-alert="">
  <a class="close" href="#">×</a>
  <p>更新に失敗しました。<span id="error-description"></span></p>
</div>

<div class="graph">
  <table id="table-for-graph" class="hide">
    <thead>
      <tr>
        <td></td>
  <?php foreach ($accesses as $a) { ?>
        <th scope="col"><?php echo substr($a['d'], 5); ?></th>
  <?php } ?>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">アクセス数</th>
  <?php foreach ($accesses as $a) { ?>
        <td><?php echo $a['count']; ?></td>
  <?php } ?>
      </tr>
    </tbody>
  </table>
</div>
<table id="data-table" class="table">
  <tr>
    <th>日付</th>
    <th>アクセス数</th>
  </tr>
<?php foreach ($accesses as $a) { ?>
  <tr>
    <td><?php echo $a['d']; ?></td>
    <td><?php echo $a['count']; ?></td>
  </tr>
<?php } ?>
</table>

