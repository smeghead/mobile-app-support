<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="description" content="">
    <meta name="author" content="">
    <?php echo Asset::css('bootstrap.css'); ?>
    <?php echo Asset::css('bootstrap-responsive.css'); ?>
    <?php echo Asset::css('style.css'); ?>
    <link href='http://fonts.googleapis.com/css?family=Limelight' rel='stylesheet' type='text/css'>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/js/public/index.js"></script>
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
    <div id="fb-root"></div>
    <script>
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1&appId=249204121787574";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="/manage"><?php echo \Config::get('app_name'); ?></a>
          <ul class="nav">
            <li class="<?php if (Uri::segment(2) != 'register') {echo 'active';} ?>"><a href="/public">Home</a></li>
            <li class="<?php if (Uri::segment(2) == 'register') {echo 'active';} ?>"><a href="/public/register">ユーザ登録</a></li>
            <li><a href="/manage">ログイン</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <?php echo $side_menu; ?>
          </div>
          <div class="fb-like-box" data-href="http://www.facebook.com/pages/Android-PaRappa/297569713643833" data-width="257" data-show-faces="true" data-stream="false" data-header="true"></div>
        </div>

        <div class="span9">
          <div class="content">
            <?php echo $content; ?>
          </div>
        </div>
      </div>
    </div>

    <footer>
      <p><?php echo \Config::get('copyright'); ?></p>
    </footer>
  </body>
</html>
