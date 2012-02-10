package com.starbug1.parappa.sdk.activity;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.webkit.WebSettings;
import android.webkit.WebView;

import com.starbug1.parappa.sdk.util.MetaDataUtil;

public class SupportActivity extends Activity {
	private String TAG = SupportActivity.class.getName();
	protected WebView webview = null;
	
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        String appCode = MetaDataUtil.getMetaData(this.getApplicationContext(), "PARAPPA_APP_CODE");
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
        String supportUrl = "http://parappa.starbug1.com/mobile/index/" + appCode + "?activity=" + callingActivityName;
        webview = new WebView(this);
        WebSettings ws = webview.getSettings();
        ws.setBuiltInZoomControls(true);
        ws.setLoadWithOverviewMode(true);
        ws.setPluginsEnabled(true);
        ws.setUseWideViewPort(true);
        ws.setJavaScriptEnabled(true);
        ws.setCacheMode(WebSettings.LOAD_DEFAULT);
        ws.setDomStorageEnabled(true);
        ws.setAppCacheEnabled(true);
        webview.setVerticalScrollbarOverlay(true);

        webview.loadUrl(supportUrl);
        setContentView(webview);
    }
    
}
