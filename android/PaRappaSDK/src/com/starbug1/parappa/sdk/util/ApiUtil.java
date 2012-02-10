package com.starbug1.parappa.sdk.util;

import java.io.ByteArrayOutputStream;
import java.util.ArrayList;
import java.util.List;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.CookieStore;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.client.params.ClientPNames;
import org.apache.http.client.params.CookiePolicy;
import org.apache.http.cookie.Cookie;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;

import android.app.Activity;
import android.util.Log;
import android.webkit.CookieManager;
import android.webkit.CookieSyncManager;

public class ApiUtil {
	private static String TAG = ApiUtil.class.getName();

	public static void init(Activity activity) {
        String appCode = MetaDataUtil.getMetaData(activity.getApplicationContext(), "PARAPPA_APP_CODE");
        if (appCode.equals("")) {
        	Log.w(TAG, "PARAPPA_APP_CODE required. define PARAPPA_APP_CODE in AndroidManifest.xml.");
        	return;
        }

		// WebViewで使うcookieの準備
		CookieSyncManager.createInstance(activity);
		CookieSyncManager.getInstance().startSync();
		CookieManager.getInstance().setAcceptCookie(true);
		CookieManager.getInstance().removeExpiredCookie();

		// HttpClientの準備
		DefaultHttpClient httpClient;
		httpClient = new DefaultHttpClient();
		httpClient.getParams().setParameter(ClientPNames.COOKIE_POLICY, CookiePolicy.BROWSER_COMPATIBILITY);
		httpClient.getParams().setParameter("http.connection.timeout", 5000);
		httpClient.getParams().setParameter("http.socket.timeout", 3000);
		HttpPost httppost = new HttpPost("http://parappa.starbug1.com/api/init/" + appCode);
		List<NameValuePair> nameValuePair = new ArrayList<NameValuePair>(3);
		nameValuePair.add(new BasicNameValuePair("activity", activity.getClass().getName()));

		// ログイン処理
		try {
			httppost.setEntity(new UrlEncodedFormEntity(nameValuePair));
			HttpResponse response = httpClient.execute(httppost);
			ByteArrayOutputStream byteArrayOutputStream = new ByteArrayOutputStream();
			response.getEntity().writeTo(byteArrayOutputStream);
		} catch (Exception e) {
			// FIXME
		}

		// HttpClientで得たCookieの情報をWebViewでも利用できるようにする
		CookieStore cookieStr = httpClient.getCookieStore();
		Cookie cookie = null;
		if ( cookieStr != null ) {
			List<Cookie> cookies = cookieStr.getCookies();
			if (!cookies.isEmpty()) {
				for (int i = 0; i < cookies.size(); i++) {
					cookie = cookies.get(i);
				}
			}
			if (cookie != null) {
				String cookieString = cookie.getName() + "=" + cookie.getValue() + "; domain=" + cookie.getDomain();
				CookieManager.getInstance().setCookie( "nicovideo.jp", cookieString);
				CookieSyncManager.getInstance().sync();
			}
		}

//		// ログイン状態で画面にアクセス
//		webview.loadUrl("http://www.nicovideo.jp/");
//		setContentView(webview);
	}
}
