package com.starbug1.parappa.sdk.activity;

import android.app.Activity;
import android.content.Context;
import android.content.pm.ActivityInfo;
import android.content.pm.ApplicationInfo;
import android.content.pm.PackageManager;
import android.content.pm.PackageManager.NameNotFoundException;
import android.os.Bundle;
import android.util.Log;
import android.webkit.WebSettings;
import android.webkit.WebView;

public class SupportActivity extends Activity {
	private String TAG = SupportActivity.class.getName();
	protected WebView webview = null;
	
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        String appCode = getMetaData(this.getApplicationContext(), "PARAPPA_APP_CODE");
        if (appCode.equals("")) {
        	Log.w(TAG, "PARAPPA_APP_CODE required. define PARAPPA_APP_CODE in AndroidManifest.xml.");
        	return;
        }
        String supportUrl = "http://parappa.starbug1.com/mobile/index/" + appCode;
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
    
    private String getMetaData(Context context, String name) {
        ApplicationInfo info = null;
		try {
			info = context.getPackageManager().getApplicationInfo(context.getPackageName(), 
					PackageManager.GET_META_DATA); 
		} catch (NameNotFoundException e) {
			Log.e(TAG, "failed to get meta-data. " + e.getMessage());
		}
		if (info == null || info.metaData == null) {
			Log.e(TAG, "PARAPPA_APP_CODE is REQUIRED in AndroidManifest.xml.");
			return "";
		}
        return info.metaData.getString(name);
    }
}
