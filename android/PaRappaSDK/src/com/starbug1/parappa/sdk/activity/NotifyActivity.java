package com.starbug1.parappa.sdk.activity;

import java.util.HashMap;
import java.util.Map;

import org.json.JSONException;
import org.json.JSONObject;

import android.R;
import android.app.Activity;
import android.app.NotificationManager;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.webkit.CookieManager;
import android.webkit.CookieSyncManager;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.widget.Toast;

import com.starbug1.parappa.sdk.PaRappa;
import com.starbug1.parappa.sdk.util.MetaDataUtil;
import com.starbug1.parappa.sdk.util.ReflectionUtil;

public class NotifyActivity extends Activity {
	private String TAG = NotifyActivity.class.getName();

	private static final int MENU_BACK = 1;
	private static final int MENU_RELOAD = 2;
	WebView webview;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);

		String notifyJson = getIntent().getStringExtra("notifyJson");
		Map<String, String> notify = new HashMap<String, String>();

		try {
			JSONObject n = new JSONObject(notifyJson);
			notify.put("notifyUrl", n.getString("notifyUrl"));
			notify.put("activity", n.getString("activity"));
			Log.d(TAG, notify.toString());
		} catch (JSONException e) {
			Log.e(TAG, e.getMessage());
			Toast.makeText(this, "告知の表示に失敗しました。", Toast.LENGTH_LONG).show();
			this.finish();
			return;
		}
		final SharedPreferences settings = this
				.getSharedPreferences(PaRappa.PARAPPA_DOMAIN, 0);
		final String parappaId = settings.getString(PaRappa.PARAPPA_ID_NAME, "");
        final String domain = MetaDataUtil.getDomain(this);
		String cookieString = String.format(
				"%s=%s ;domain=%s",
				PaRappa.PARAPPA_ID_NAME,
				parappaId,
				domain);
		CookieManager.getInstance().setCookie(domain, cookieString);
		CookieSyncManager.getInstance().sync();

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
		webview.addJavascriptInterface(new JsObj(), "___android___");

        String url = String.format(
        		"http://%s%s?activity=%s",
        		MetaDataUtil.getDomain(this),
        		notify.get("notifyUrl"),
        		notify.get("activity"));
        Log.d(TAG, url);
        webview.loadUrl(url);
        setContentView(webview);
		
		NotificationManager manager = (NotificationManager) getSystemService(NOTIFICATION_SERVICE);
		manager.cancelAll();
	}
	
	public class JsObj {
		public void jump(String activityName) {
			Log.d(TAG, "activityName: " + activityName);
			final Class<Activity> activity = ReflectionUtil.getClass(activityName);
			if (activity == null) {
				Log.e(TAG, "Activity class name is invalid.");
				return;
			}
			Intent intent = new Intent(NotifyActivity.this, activity);
			NotifyActivity.this.startActivity(intent);
		}
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
