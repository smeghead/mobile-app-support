<link href="/assets/js/google-code-prettify/prettify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/assets/js/google-code-prettify/prettify.js"></script>

        <!-- Main hero unit for a primary marketing message or call to action -->
        <!-- Example row of columns -->
        <div class="row-fluid">
          <div class="">
            <h2>ユーザサポート</h2>
            <p>
              Andoridアプリにユーザサポート機能を付与することができます。サポート機能で
              エンドユーザに提供するコンテンツは管理サイトから簡単に運営管理することができます。
            </p>
            <h3>PaRappaのユーザサポート機能</h3>
            <p>
              Androidマーケットには、ダウンロードページとレビュー機能がありますが、
              エンドユーザに対して満足してもらえるユーザサポートをすることを考えると
              Androidマーケットの機能だけでは、不十分です。
            </p>
            <p>
              PaRappa を導入することで、Androidアプリに簡単にユーザサポート機能を追加することができます。
              お知らせやヘルプページとして使えるページ・FAQページ・問い合わせフォームが組込まれています。
            </p>
            <div>
              <img src="/images/supportsite-top.png" title="トップ" />
              <img src="/images/supportsite-faq.png" title="FAQ" />
              <img src="/images/supportsite-inquiry.png" title="お問い合わせ" />
            </div>
            <h3>使い方</h3>
            <p>
              PaRappaのユーザサポート機能を導入するのはとても簡単です。
              ユーザサポート機能を呼び出すActivityクラスのonCreateメソッドで
              PaRappaクラスのインスタンスを生成します。
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
            <p>
              これで、お知らせ・FAQ・お問い合わせの機能がAndroidアプリに組込まれます。
            </p>
            <p>
              上記に加えて、管理サイトで生成したAPPコードの設定が必要ですが、簡単に
              Androidアプリに、ユーザサポートの機能を簡単に追加できることはわかってもらえると思います。
            </p>
          </div>
        </div>
