package com.starbug1.parappa.sdk.activity;

import android.R;
import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.webkit.WebSettings;
import android.webkit.WebView;

import com.starbug1.parappa.sdk.util.MetaDataUtil;

public class SupportActivity extends Activity {
	private String TAG = SupportActivity.class.getName();
	protected WebView webview = null;

	private static final int MENU_BACK = 1;
	private static final int MENU_RELOAD = 2;

	@Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        String appCode = MetaDataUtil.getMetaData(this.getApplicationContext(), "PARAPPA_APP_CODE", "");
        if (appCode.equals("")) {
        	Log.w(TAG, "PARAPPA_APP_CODE required. define PARAPPA_APP_CODE in AndroidManifest.xml.");
        	return;
        }
        Intent intent = getIntent();
        String callingActivityName = intent.getStringExtra("parentActivity");
        if (callingActivityName == null || callingActivityName.length() == 0) {
        	Log.w(TAG, "activity name unknown.");
        	callingActivityName = "[unknown]";
        }
        String supportUrl = String.format("http://%s/mobile/index/%s?activity=%s",
        		MetaDataUtil.getDomain(this),
        		appCode,
        		callingActivityName);
        webview = new WebView(this);
        WebSettings ws = webview.getSettings();
        ws.setBuiltInZoomControls(true);
        ws.setLoadWithOverviewMode(true);
        ws.setPluginsEnabled(true);
        ws.setUseWideViewPort(true);
        ws.setJavaScriptEnabled(true);
        ws.setCacheMode(WebSettings.LOAD_NO_CACHE);
        ws.setDomStorageEnabled(true);
        ws.setAppCacheEnabled(true);
        webview.setVerticalScrollbarOverlay(true);

        webview.loadUrl(supportUrl);
        setContentView(webview);
    }
    
    /** メニューの生成イベント */
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
    	super.onCreateOptionsMenu(menu);
    	menu.add(0, MENU_RELOAD, 0, "リロード").setIcon(R.drawable.ic_menu_rotate);
    	menu.add(0, MENU_BACK, 0, "閉じる").setIcon(R.drawable.ic_menu_delete);
    	return true;
    }
    /** メニューがクリックされた時のイベント */
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
    	switch ( item.getItemId() ) {
    	case MENU_RELOAD:
    		webview.reload();
    		break;
    	case MENU_BACK:
    		this.finish();
    		break;
    	}
    	return true;
    }
}
