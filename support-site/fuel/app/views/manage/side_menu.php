          <h5>メニュー</h5>
          <ul>
            <li><a href="/manage/">アプリ一覧</a></li>
<?php foreach ($apps as $app) { ?>
            <li><a href="/manage/app/<?php echo $app['id'] ?>"><?php echo $app['name'] ?></a></li>
            <ul>
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
            <li><a href="/manage/settings">設定</a></li>
            <li><a href="/manage/logout">ログアウト</a></li>
          </ul>
<!--
          <ul>
            <li><a href="">ダッシュボード</a></li>
            <li><a href="">サポートサイト管理</a></li>
            <ul>
              <li><a href="">ホーム</a></li>
              <li><a href="">FAQ管理</a></li>
              <li><a href="">問い合わせ管理</a></li>
            </ul>
            <li><a href="">ステータス通知</a></li>
            <li><a href="">統計情報</a></li>
          </ul>
-->
