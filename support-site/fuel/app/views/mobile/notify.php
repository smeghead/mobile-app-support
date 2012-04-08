<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo h($app->name); ?>  お知らせ</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
  <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
  <script src="/assets/js/mobile/notify.js"></script>
  <script src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>
</head>
<body>

<!-- ############ home ############ -->
<div data-role="page" id="home">

  <div data-role="header">
    <h1>
      <?php echo h($app->name); ?> ユーザサポート
    </h1>
    <div data-role="navbar">
      <ul>
      <li><a href="/mobile/index/<?php echo $app->code; ?>#home" data-direction="reverse" data-icon="home">ホーム</a></li>
        <li><a href="/mobile/index/<?php echo $app->code; ?>#faq" data-icon="info">FAQ</a></li>
        <li><a href="/mobile/index/<?php echo $app->code; ?>#inquiry" data-icon="search">問い合わせ</a></li>
      </ul>
    </div><!-- /navbar -->
  </div><!-- /header -->


<?php
$messages = array_values($notify->notify_messages);
$message = $messages[0];
?>
  <div data-role="content"> 
    <?php echo $message->content; ?>
    <div>
<?php if ($message->action_type == 1) { ?>
      <a id="jump-to-activity" data-role="button">OK</a>
<?php } else { ?>
      <a id="jump-to-market" data-role="button">Android Marketへ</a>
<?php } ?>
    </div>
  </div><!-- /content -->

  <div data-role="footer">    
    <h5 style="text-align: right;">Powered by <a href="/" data-ajax="false">PaRappa</a>. <?php echo \Config::get('copyright'); ?></h5>
  </div><!-- /footer -->
</div><!-- /page -->

<div data-role="page" id="dialog">
  <div data-role="header"><h1><span id="dialog-header"></span></h1></div>
  <div data-role="content">
    <span id="dialog-content"></span>
    <a href="#faq" data-role="button" data-rel="back" data-theme="c">閉じる</a>
  </div>
</div>

</body>
</html>
