<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="description" content="">
    <meta name="author" content="">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <?php echo Asset::css('bootstrap.css'); ?>
    <?php echo Asset::css('bootstrap-responsive.css'); ?>
    <?php echo Asset::css('style.css'); ?>

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->

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
          <a class="brand" href="/public"><?php echo $title; ?></a>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="content">
        <h1>エラー</h1>
        <h2>404 Not Found</h2>
        <div>
          ページが見付かりません。
        </div>
      </div>
    </div>
    <footer>
      <p>&copy; smeghead 2012</p>
    </footer>

  </body>
</html>
