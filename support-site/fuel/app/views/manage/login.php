<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="description" content="">
    <meta name="author" content="">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
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
          <a class="brand" href="#"><?php echo $title; ?></a>
          <ul class="nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
          <p class="pull-right">Logged in as <a href="#">username</a></p>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="content">
        <h1>ログイン</h1>
        <form method="post" action="/manage/login">
          <fieldset>
            <div class="clearfix <?php if (isset($errors['user_id'])) { echo 'error'; } ?>">
              <label for="user_id">ユーザID</label>
              <div class="input">
                <input class="xlarge" id="user_id" name="user_id" size="30" type="text" value="<?php echo Input::post('user_id') ?>" />
        <?php if (isset($errors['user_id'])) { ?>
                <span class="help-inline"><?php echo $errors['user_id'] ?></span>
        <?php } ?>
              </div>
            </div><!-- /clearfix -->
            <div class="clearfix <?php if (isset($errors['passwd'])) { echo 'error'; } ?>">
              <label for="passwd">パスワード</label>
              <div class="input">
                <input class="xlarge" id="passwd" name="passwd" size="30" type="password" value="<?php echo Input::post('passwd') ?>" />
        <?php if (isset($errors['passwd'])) { ?>
                <span class="help-inline"><?php echo $errors['passwd'] ?></span>
        <?php } ?>
              </div>
            </div><!-- /clearfix -->
          </fieldset>

          <div class="actions">
            <input type="submit" class="btn primary" value="ログイン">
          </div>
        </form>
      </div>
    </div>

    <script type="text/javascript">
$(function(){
  $('#user_id').focus();
});
    </script>
  </body>
</html>
