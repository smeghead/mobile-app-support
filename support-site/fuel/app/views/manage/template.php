<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="description" content="">
    <meta name="author" content="">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.dimensions.js"></script>
    <script type="text/javascript" src="/assets/js/ui.mouse.js"></script>
    <script type="text/javascript" src="/assets/js/ui.draggable.js"></script>
    <script type="text/javascript" src="/assets/js/ui.draggable.ext.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-modal.js"></script>
    <?php echo Asset::css('bootstrap.css'); ?>
    <?php echo Asset::css('style.css'); ?>

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <style type="text/css">
      body {
        padding-top: 60px;
      }
    </style>

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico">
  </head>

  <body>

    <div class="topbar">
      <div class="topbar-inner">
        <div class="container-fluid">
          <a class="brand" href="/manage"><?php echo $title; ?></a>
          <ul class="nav">
            <li class="active"><a href="/manage">アプリ一覧</a></li>
            <li><a href="/manage/settings">設定</a></li>
          </ul>
          <p class="pull-right">Logged in as <a href="/manage"><?php echo $user_name; ?></a></p>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="sidebar">
        <?php echo $side_menu; ?>
      </div>

      <div class="content">
        <?php echo $content; ?>
      </div>

    </div>
    <footer>
      <p>&copy; smeghead 2011</p>
    </footer>

  </body>
</html>
