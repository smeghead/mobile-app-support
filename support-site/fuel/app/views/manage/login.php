<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="description" content="">
    <meta name="author" content="">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-alert.js"></script>
    <?php echo Asset::css('bootstrap.css'); ?>
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
          <a class="brand" href="/public"><?php echo $title; ?></a>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="content">
        <h1>ログイン</h1>
        <?php if (isset($errors['login_error'])) { ?>
          <div class="alert alert-error">
            <a class="close" data-dismiss="alert">&times;</a>
            <strong>エラー!</strong><?php echo $errors['login_error'] ?>
          </div>
        <?php } ?>
        <form method="post" action="/manage/login" class="form-horizontal">
          <fieldset>
            <div class="control-group <?php if (isset($errors['email'])) { echo 'error'; } ?>">
              <label for="email" class="control-label">メールアドレス</label>
              <div class="controls">
                <input class="xlarge" id="email" name="email" size="30" type="text" value="<?php echo Input::post('email') ?>" />
        <?php if (isset($errors['email'])) { ?>
                <span class="help-inline"><?php echo $errors['email'] ?></span>
        <?php } ?>
              </div>
            </div><!-- /clearfix -->
            <div class="control-group <?php if (isset($errors['passwd'])) { echo 'error'; } ?>">
              <label for="passwd" class="control-label">パスワード</label>
              <div class="controls">
                <input class="xlarge" id="passwd" name="passwd" size="30" type="password" value="<?php echo Input::post('passwd') ?>" />
        <?php if (isset($errors['passwd'])) { ?>
                <span class="help-inline"><?php echo $errors['passwd'] ?></span>
        <?php } ?>
              </div>
            </div><!-- /clearfix -->
          </fieldset>

          <div class="form-actions">
            <input type="submit" class="btn btn-primary" value="ログイン">
          </div>
        </form>
      </div>
    </div>
    <footer>
      <p>&copy; smeghead 2012</p>
    </footer>

    <script type="text/javascript">
$(function(){
  $('#user_id').focus();
});
    </script>
  </body>
</html>
