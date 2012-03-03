<link href="/assets/js/google-code-prettify/prettify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/assets/js/google-code-prettify/prettify.js"></script>
<script type="text/javascript" src="/assets/js/manage/document.js"></script>
<ul class="breadcrumb">
  <li class="active">
    <a href="/manage/document">ドキュメント</a> <span class="divider">/</span>
  </li>
</ul>
<h1>ドキュメント</h1>

<h2>導入方法</h2>

<p>
  eclipseを使ってAndroidアプリを作成している場合を例に導入方法を説明します。
</p>

<h3>会員登録</h3>
<ul>
  <li>http://parappa.me/ から会員登録を行ないます。</li>
  <li>http://parappa.me/manage からログインを行ない、PaRappaを導入するAndroidアプリを登録します。</li>
  <li>登録語のアプリページに表示されるアプリコードが、SDKの導入に必要になりますので控えておいて下さい。</li>
</ul>

<h3>eclipseでの設定</h3>

<ul>
  <li>eclipseのAndroidアプリプロジェクトディレクトリ配下にlibディレクトリを作成します。</li>
  <li>作成したlibディレクトリに、parappa.jarを配置します。</li>
  <li>eclipseのプロジェクトプロパティからJavaビルドパスを選択し、ライブラリの追加を行ないparappa.jarを追加します。</li>
</ul>

<h3>AndroidManifest.xml の修正</h3>

<p>
  PaRappaを利用するにあたり、インターネットアクセスが必要なので、manifestタグ配下にPermissionを追加します。
</p>

<pre class="prettyprint"><code class="language-xml">
&lt;manifest xmlns:android="http://schemas.android.com/apk/res/android"
    package="com.example.sample"
    android:versionCode="1"
    android:versionName="1.0" &gt;

    &lt;!-- PaRappa needs internet access permission. --&gt;
    &lt;uses-permission android:name="android.permission.INTERNET" /&gt;
    &lt;uses-permission android:name="android.permission.ACCESS_NETWORK_STATE"/&gt;

</code></pre>

<p>
  applicationタグ配下に以下のタグを追加します。
</p>

<pre class="prettyprint"><code class="language-xml">
        &lt;!-- PaRappa Support Activity --&gt;
        &lt;activity
            android:name="me.parappa.sdk.activity.SupportActivity"
            android:label="@string/app_name"
            android:configChanges="orientation|keyboardHidden"&gt;
        &lt;/activity&gt;
        &lt;!-- PaRappa Notify Activity --&gt;
        &lt;activity
            android:name="me.parappa.sdk.activity.NotifyActivity"
            android:label="@string/app_name"
            android:configChanges="orientation|keyboardHidden" /&gt;
        &lt;!-- PaRappa Notify Service --&gt;
        &lt;service android:name="me.parappa.sdk.service.NotifyService" /&gt;
        &lt;!-- PaRappa Receiver --&gt;
        &lt;receiver android:name="me.parappa.sdk.receiver.StartReceiver"&gt;
            &lt;intent-filter&gt;
                &lt;action android:name="android.intent.action.BOOT_COMPLETED"/&gt;
                &lt;action android:name="com.android.vending.INSTALL_REFERRER" /&gt;
                &lt;category android:name="android.intent.category.DEFAULT" /&gt;
            &lt;/intent-filter&gt;
        &lt;/receiver&gt;
        &lt;!-- PaRappa Application Code Setting --&gt;
        &lt;meta-data android:name="PARAPPA_APP_CODE" android:value="********"/&gt;
</code></pre>
<p>
  上のPARAPPA_APP_CODE の android:value="********" の ******** の部分は、
  控えておいたアプリコードを記入して下さい。
</p>

<h3>アクティビティクラスの修正</h3>

<p>
  各アクティビティのonCreateメソッドで、PaRappa.init(this);を行なって下さい。
  各アクティビティの起動ログを集計できるようになります。
</p>
<pre class="prettyprint"><code class="language-java">
    <strong>/** PaRappa instance. **/
    private PaRappa parappa;</strong>

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.main);
        <strong>// create PaRappa instance.
        parappa = new PaRappa(this);</strong>
    }
</code></pre>

<p>
  メニューなどからユーザサポート機能を呼び出す時に、startSupportActivityメソッドを呼び出します。
</p>
<pre class="prettyprint"><code class="language-java">
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
      switch (item.getItemId()) {
      case R.id.menu_support:
        <strong>// open PaRappa suport activity feature.
        parappa.startSupportActivity();</strong>
        break;
      }
      return true;
    }
            </code></pre>




