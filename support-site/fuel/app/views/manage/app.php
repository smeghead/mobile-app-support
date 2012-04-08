<script type="text/javascript" src="/assets/js/manage/app.js"></script>
<ul class="breadcrumb">
  <li>
    <a href="/manage/">アプリ一覧</a> <span class="divider">/</span>
  </li>
  <li>
    <a href="/manage/app/<?php echo $app->id; ?>"><?php echo $app->name; ?></a> <span class="divider">/</span>
  </li>
  <li class="active">
    <a href="">アプリ設定</a>
  </li>
</ul>
<h1>アプリ設定</h1>
<input class="hide" id="id_input" type="hidden" value="<?php echo $app->id; ?>" />
<div id="alert-message-success" class="alert alert-success hide">
  <a class="close" data-dismiss="alert">&times;</a>
  <p>更新しました。</p>
</div>
<div id="alert-message-error" class="alert alert-error hide">
  <a class="close" data-dismiss="alert">&times;</a>
  <p>更新に失敗しました。<span id="error-description"></span></p>
</div>

<table class="table">
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
    <th>パッケージ名</th>
    <td>
      <input class="xlarge hide" id="package_name_input" size="20" type="text" value="" />
      <span id="package_name" class="text"><?php echo $app->package_name; ?></span>
      <span class="right package_name-edit edit-icon" title="編集">&nbsp;</span>
    </td>
  </tr>
  <tr>
    <th>カテゴリ</th>
    <td>
      <select id="category_input" class="hide">
        <option value="0">その他</option>
<?php foreach ($app_categories as $category) { ?>
          <option value="<?php echo $category->category_code; ?>" <?php if ($category->category_code == $app->category) {echo 'selected="selected"';} ?>><?php echo $category->name; ?></option>
<?php } ?>
      </select>
      <span id="category" class="text"></span>
      <span class="right category-edit edit-icon" title="編集">&nbsp;</span>
    </td>
  </tr>
  <tr>
    <th>アプリコード<span class="icon-question-sign" rel="tooltip" title="アプリにSDKを組込むときに必要なコードです"></span></th>
    <td>
      <span id="code" class="text"><?php echo $app->code; ?></span>
    </td>
  </tr>
</table>
<div class="row banner-menu">
  <div class="span3 block">
    <h4><a href="/manage/app_site/<?php echo $app->id; ?>">ユーザサポート管理</a></h4>
    <div><a href="/manage/app_site/<?php echo $app->id; ?>"><img src="/assets/img/manage-banner.png" alt="ユーザサポート管理" /></a></div>
  </div>
  <div class="span3 block">
    <h4><a href="/manage/app_notify/<?php echo $app->id; ?>">告知機能</a></h4>
    <div><a href="/manage/app_notify/<?php echo $app->id; ?>"><img src="/assets/img/notify-banner.png" alt="告知機能" /></a></div>
  </div>
  <div class="span3 block">
    <h4><a href="/manage/app_analysis/<?php echo $app->id; ?>">統計情報</a></h4>
    <div><a href="/manage/app_analysis/<?php echo $app->id; ?>"><img src="/assets/img/analysis-banner.png" alt="統計情報" /></a></div>
  </div>
</div>
