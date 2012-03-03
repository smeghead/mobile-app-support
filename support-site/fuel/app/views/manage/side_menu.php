          <script type="text/javascript" src="/assets/js/manage/side-menu.js"></script>
          <h5>メニュー</h5>
          <ul>
            <li><a href="/manage/">アプリ一覧</a></li>
            <ul id="menu-app">
<?php foreach ($apps as $app) { ?>
              <li data-id="<?php echo $app['id']; ?>" class="menu-app"><a href="/manage/app/<?php echo $app['id'] ?>"><?php echo $app['name'] ?></a></li>
              <ul class="menu-detail">
                <li><a href="/manage/app_site/<?php echo $app['id'] ?>">ユーザサポート機能管理</a></li>
                <ul>
                  <li><a href="/manage/app_site/<?php echo $app['id'] ?>#top">ホーム</a></li>
                  <li><a href="/manage/app_site/<?php echo $app['id'] ?>#faq">FAQ管理</a></li>
                  <li><a href="/manage/app_site/<?php echo $app['id'] ?>#inquiry">問い合わせ管理</a></li>
                </ul>
                <li><a href="/manage/app_notify/<?php echo $app['id'] ?>">告知設定</a></li>
                <li><a href="/manage/app_analysis/<?php echo $app['id'] ?>">統計情報</a></li>
              </ul>
<?php } ?>
            </ul>
            <li><a href="/manage/document">ドキュメント</a></li>
            <li><a href="/manage/settings">設定</a></li>
            <li><a href="/manage/logout">ログアウト</a></li>
          </ul>
