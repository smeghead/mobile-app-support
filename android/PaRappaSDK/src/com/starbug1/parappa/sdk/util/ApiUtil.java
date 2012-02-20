package com.starbug1.parappa.sdk.util;

import java.io.ByteArrayOutputStream;
import java.util.ArrayList;
import java.util.List;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.CookieStore;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.client.params.ClientPNames;
import org.apache.http.client.params.CookiePolicy;
import org.apache.http.cookie.Cookie;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONObject;

import android.app.Activity;
import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.util.Log;
import android.webkit.CookieManager;
import android.webkit.CookieSyncManager;

import com.starbug1.parappa.sdk.PaRappa;

public class ApiUtil {
	private static String TAG = ApiUtil.class.getName();

	public static boolean init(Activity activity, String userAgent, String jsonLog) {
        String appCode = MetaDataUtil.getMetaData(activity.getApplicationContext(), "PARAPPA_APP_CODE", "");
        if (appCode.equals("")) {
        	Log.w(TAG, "PARAPPA_APP_CODE required. define PARAPPA_APP_CODE in AndroidManifest.xml.");
        	return false;
        }
        final String domain = MetaDataUtil.getMetaData(activity, "PARAPPA_DOMAIN", PaRappa.PARAPPA_DOMAIN);

        DefaultHttpClient httpClient = preRequest(activity, userAgent);
		HttpPost httppost = new HttpPost("http://" + domain + "/api/mobile_init.json/" + appCode);
		List<NameValuePair> nameValuePair = new ArrayList<NameValuePair>(3);
		nameValuePair.add(new BasicNameValuePair("activity", activity.getClass().getName()));
		nameValuePair.add(new BasicNameValuePair("log", jsonLog));

		try {
			Log.d(TAG, "post");
			httppost.setEntity(new UrlEncodedFormEntity(nameValuePair));
			HttpResponse response = httpClient.execute(httppost);
			Log.d(TAG, "posted");
			ByteArrayOutputStream byteArrayOutputStream = new ByteArrayOutputStream();
			response.getEntity().writeTo(byteArrayOutputStream);
			Log.d(TAG, byteArrayOutputStream.toString());
			JSONObject result = new JSONObject(byteArrayOutputStream.toString());
			if (!result.has("error") || !JSONObject.NULL.equals(result.get("error"))) {
				Log.d(TAG, result.getString("error"));
				return false;
			}
			postRequest(domain, httpClient);
			return true;
		} catch (Exception e) {
			Log.e(TAG, "http access error. " + e.getMessage());
			return false;
		}
	}

	public static Notify getNotify(Context context, String userAgent) {
        String appCode = MetaDataUtil.getMetaData(context.getApplicationContext(), "PARAPPA_APP_CODE", "");
        if (appCode.equals("")) {
        	Log.w(TAG, "PARAPPA_APP_CODE required. define PARAPPA_APP_CODE in AndroidManifest.xml.");
        	return null;
        }
        final String domain = MetaDataUtil.getMetaData(context, "PARAPPA_DOMAIN", PaRappa.PARAPPA_DOMAIN);

        DefaultHttpClient httpClient = preRequest(context, userAgent);
		HttpGet get = new HttpGet("http://" + domain + "/api/notify.json/" + appCode + "?activity=" + context.getClass().getName());

		Notify notify;
		try {
			Log.d(TAG, "get");
			HttpResponse response = httpClient.execute(get);
			Log.d(TAG, "got");
			ByteArrayOutputStream byteArrayOutputStream = new ByteArrayOutputStream();
			response.getEntity().writeTo(byteArrayOutputStream);
			Log.d(TAG, byteArrayOutputStream.toString());
			JSONObject result = new JSONObject(byteArrayOutputStream.toString());
			if (!result.has("error") || !JSONObject.NULL.equals(result.get("error"))) {
				Log.d(TAG, result.getString("error"));
				return null;
			}
			notify = new Notify(
					result.getString("subject"), 
					result.getString("activity"), 
					appCode, 
					result.getInt("notify_id"));
			postRequest(domain, httpClient);
			return notify;
		} catch (Exception e) {
			Log.e(TAG, "http access error. " + e.getMessage());
			return null;
		}
	}

	private static void postRequest(final String domain,
			DefaultHttpClient httpClient) {
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
				Log.d(TAG, "cookieString: " + cookieString);
				CookieManager.getInstance().setCookie(domain, cookieString);
				CookieSyncManager.getInstance().sync();
			}
		}
	}

	private static DefaultHttpClient preRequest(Context context,
			String userAgent) {
		// WebViewで使うcookieの準備
		CookieSyncManager.createInstance(context);
		CookieSyncManager.getInstance().startSync();
		CookieManager.getInstance().setAcceptCookie(true);
		CookieManager.getInstance().removeExpiredCookie();

		// HttpClientの準備
		DefaultHttpClient httpClient;
		httpClient = new DefaultHttpClient();
		httpClient.getParams().setParameter(ClientPNames.COOKIE_POLICY, CookiePolicy.BROWSER_COMPATIBILITY);
		httpClient.getParams().setParameter("http.connection.timeout", 5000);
		httpClient.getParams().setParameter("http.socket.timeout", 3000);
		httpClient.getParams().setParameter("http.useragent", userAgent);
		return httpClient;
	}
	public static class Notify {
		public String activity;
		public String subject;
		public String appCode;
		public int notifyId;
		public Notify(String subject, String activity, String appCode, int notifyId) {
			this.activity = activity;
			this.subject = subject;
			this.appCode = appCode;
			this.notifyId = notifyId;
		}
	}

	public static boolean isConnected(final Context context) {
		  ConnectivityManager connManager = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
		  final NetworkInfo networkInfo = connManager.getActiveNetworkInfo();
		  return (networkInfo != null && networkInfo.isConnected());
	}
}
