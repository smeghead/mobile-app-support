<link href="/assets/js/google-code-prettify/prettify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/assets/js/google-code-prettify/prettify.js"></script>

        <!-- Main hero unit for a primary marketing message or call to action -->
        <!-- Example row of columns -->
        <div class="row-fluid">
          <div class="">
            <h2>サポート</h2>
            <p>
              Andoridアプリにサポート機能を付与することができます。サポート機能で
              エンドユーザに提供するコンテンツは管理サイトから簡単に運営管理することができます。
            </p>
            <pre class="prettyprint"><code class="language-java">
public class PaRappaSampleActivity extends Activity {
  /** PaRappa instance. **/
  private PaRappa parappa;
  
    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.main);
        // create PaRappa instance.
        parappa = new PaRappa(this);
    }

    @Override
    public boolean onCreateOptionsMenu(android.view.Menu menu) {
      super.onCreateOptionsMenu(menu);
      MenuInflater inflater = getMenuInflater();
      inflater.inflate(R.menu.main_menu, menu);
      return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
      switch (item.getItemId()) {
    case R.id.menu_support:
      // open PaRappa suport activity feature.
      parappa.startSupportActivity();
      break;
    }
      return true;
    }
}
            </code></pre>
          </div>
        </div>
