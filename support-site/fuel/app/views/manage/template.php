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
    <script type="text/javascript" src="/assets/js/bootstrap-alert.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-modal.js"></script>
    <?php echo Asset::css('bootstrap.css'); ?>
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <?php echo Asset::css('bootstrap-responsive.css'); ?>
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
    <link rel="shortcut icon" href="/favicon.ico">
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="/manage"><?php echo $title; ?></a>
          <ul class="nav">
            <li class="active"><a href="/manage">アプリ一覧</a></li>
            <li><a href="/manage/settings">設定</a></li>
          </ul>
          <p class="navbar-text pull-right">
            <a href="/manage"><?php echo $user_name; ?></a> さんとしてログインしています。
            <a href="/manage/logout">ログアウトする</a>
          </p>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <?php echo $side_menu; ?>
          </div>
        </div>

        <div class="span9">
          <div class="content">
            <?php echo $content; ?>
          </div>
        </div>
      </div>
    </div>
    <footer>
      <p>&copy; smeghead 2012</p>
    </footer>

  </body>
</html>
