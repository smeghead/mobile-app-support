<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="description" content="">
    <meta name="author" content="">
    <?php echo Asset::css('bootstrap.css'); ?>

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
          <a class="brand" href="/public"><?php echo $title; ?></a>
          <ul class="nav">
            <li class="active"><a href="/public">Home</a></li>
            <li><a href="/public/about">About</a></li>
            <li><a href="/public/contact">Contact</a></li>
          </ul>
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

  </body>
</html>
