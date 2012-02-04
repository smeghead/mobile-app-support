<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $app->name; ?> サポート</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
  <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
  <script src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>
</head>
<body>
<div data-role="page" id="home">

  <div data-role="header">
    <h1>
      <?php echo $app->name; ?> サポート
    </h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#home" data-icon="home">ホーム</a></li>
        <li><a href="#faq" data-icon="info">FAQ</a></li>
        <li><a href="#inquiry" data-icon="search">問い合わせ</a></li>
      </ul>
    </div><!-- /navbar -->
  </div><!-- /header -->


  <div data-role="content"> 
    <?php print $content; ?>
  </div><!-- /content -->

  <div data-role="footer">    
    <h5 style="text-align: right;">Copyright smeghead.</h5>
  </div><!-- /footer -->
</div><!-- /page -->

<div data-role="page" id="faq">

  <div data-role="header">
    <h1>
      無駄新聞 サポート
    </h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#home" data-icon="home">ホーム</a></li>
        <li><a href="#faq" data-icon="info">FAQ</a></li>
        <li><a href="#inquiry" data-icon="search">問い合わせ</a></li>
      </ul>
    </div><!-- /navbar -->
  </div><!-- /header -->


  <div data-role="content"> 
      <p>
      無駄新聞について問題がありましたら、この解決方法をお試し下さい。
      解決方法が無かった場合は、<a href="#inquiry" data-role="button" data-inline="true">問い合わせ</a>からご連絡下さい。
      </p>
      <ul data-role="listview">
        <li data-role="list-divider">アプリの動作</li>
        <li><a href="index.html">アプリが起動しない</a></li>
        <li><a href="index.html">新着通知時に音がうるさい</a></li>
        <li><a href="index.html">バッテリーを節約したい</a></li>
        <li data-role="list-divider">その他</li>
        <li><a href="index.html">無料ですか？</a></li>
      </ul>
      <p>
      解決しない場合は、<a href="#inquiry" data-role="button" data-inline="true">問い合わせ</a>からご連絡下さい。
      </p>
  </div><!-- /content -->

  <div data-role="footer">    
    <h5 style="text-align: right;">Copyright smeghead.</h5>
  </div><!-- /footer -->
</div><!-- /page -->


<div data-role="page" id="inquiry">

  <div data-role="header">
    <h1>
      無駄新聞 サポート
    </h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#home" data-icon="home">ホーム</a></li>
        <li><a href="#faq" data-icon="info">FAQ</a></li>
        <li><a href="#inquiry" data-icon="search">問い合わせ</a></li>
      </ul>
    </div><!-- /navbar -->
  </div><!-- /header -->

  <div data-role="content"> 

    <p>
      無駄新聞について、問題や要望・感想などありましたら、下のフォームからお知らせ下さい。
    </p>
    <form class="form-horizontal">
      <ul data-role="listview" data-inset="true">
        <li data-role="fieldcontain">
          <label for="email">メールアドレス:</label>
          <input type="email" name="email" id="email" value=""  />
        </li>
        <li data-role="fieldcontain">
          <label for="textarea">内容:</label>
          <textarea cols="40" rows="8" name="textarea" id="textarea"></textarea>
        </li>

        <li class="ui-body ui-body-b">
          <fieldset class="ui-grid-a">
            <div class="ui-block-a"><button type="submit" data-theme="d">Cancel</button></div>
            <div class="ui-block-b"><button type="submit" data-theme="a">Submit</button></div>
          </fieldset>
        </li>
        
      </ul>
    </form>
  </div>

  <div data-role="footer">    
    <h5 style="text-align: right;">Copyright smeghead.</h5>
  </div><!-- /footer -->
</div><!-- /page -->

</body>
</html>
