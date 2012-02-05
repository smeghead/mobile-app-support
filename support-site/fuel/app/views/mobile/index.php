<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $app->name; ?> サポート</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
  <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
  <script src="/assets/js/mobile/index.js"></script>
  <script src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>
</head>
<body>

<!-- ############ home ############ -->
<div data-role="page" id="home">

  <div data-role="header">
    <h1>
      <?php echo $app->name; ?> サポート
    </h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#home" data-direction="reverse" data-icon="home">ホーム</a></li>
        <li><a href="#faq" data-icon="info">FAQ</a></li>
        <li><a href="#inquiry" data-icon="search">問い合わせ</a></li>
      </ul>
    </div><!-- /navbar -->
  </div><!-- /header -->


  <div data-role="content"> 
    <?php print $content; ?>
  </div><!-- /content -->

  <div data-role="footer">    
    <h5 style="text-align: right;">Powered by <a href="/" data-ajax="false">PaRappa</a>. Copyright smeghead.</h5>
  </div><!-- /footer -->
</div><!-- /page -->

<!-- ############ faq ############ -->
<div data-role="page" id="faq">

  <div data-role="header">
    <h1>
      <?php echo $app->name; ?> サポート
    </h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#home" data-direction="reverse" data-icon="home">ホーム</a></li>
        <li><a href="#faq" data-icon="info">FAQ</a></li>
        <li><a href="#inquiry" data-icon="search">問い合わせ</a></li>
      </ul>
    </div><!-- /navbar -->
  </div><!-- /header -->


  <div data-role="content"> 
      <p>
      <?php echo $app->name; ?> について問題がありましたら、この解決方法をお試し下さい。
      解決方法が無かった場合は、<a href="#inquiry" data-role="button" data-inline="true">問い合わせ</a>からご連絡下さい。
      </p>
      <ul id="faqs" data-role="listview">
      </ul>
      <p>
      解決しない場合は、<a href="#inquiry" data-role="button" data-inline="true">問い合わせ</a>からご連絡下さい。
      </p>
  </div><!-- /content -->

  <div data-role="footer">    
    <h5 style="text-align: right;">Powered by <a href="/" data-ajax="false">PaRappa</a>. Copyright smeghead.</h5>
  </div><!-- /footer -->
</div><!-- /page -->

<!-- ############ inquiry ############ -->
<div data-role="page" id="inquiry">

  <div data-role="header">
    <h1>
      <?php echo $app->name; ?> サポート
    </h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#home" data-direction="reverse" data-icon="home">ホーム</a></li>
        <li><a href="#faq" data-icon="info">FAQ</a></li>
        <li><a href="#inquiry" data-icon="search">問い合わせ</a></li>
      </ul>
    </div><!-- /navbar -->
  </div><!-- /header -->

  <div data-role="content"> 

    <p>
      <?php echo $app->name; ?>について、問題や要望・感想などありましたら、下のフォームからお知らせ下さい。
    </p>
    <form class="form-horizontal" id="inquiry_form">
      <ul data-role="listview" data-inset="true">
        <li data-role="fieldcontain">
          <label for="email">メールアドレス:</label>
          <input type="email" name="email" id="email" value=""  />
        </li>
        <li data-role="fieldcontain">
          <label for="question">内容:</label>
          <textarea cols="40" rows="8" name="textarea" id="question"></textarea>
        </li>

        <li class="ui-body ui-body-b">
          <fieldset class="ui-grid-a">
            <div class="ui-block-b"><input type="submit" data-theme="a" value="Submit"></div>
          </fieldset>
        </li>
        
      </ul>
    </form>
<!--
    <h2>質問履歴</h2>
    <ul id="inquiry-history" data-role="listview">
      <li><a href="#">2012-02-02 barbar...</a></li>
      <li><a href="#">2012-02-02 foofoo...</a></li>
    </ul>
-->
  </div>

  <div data-role="footer">    
    <h5 style="text-align: right;">Powered by <a href="/" data-ajax="false">PaRappa</a>. Copyright smeghead.</h5>
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
