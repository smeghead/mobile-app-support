package me.parappa.sdk.util;

import java.io.ByteArrayOutputStream;
import java.util.ArrayList;
import java.util.List;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import me.parappa.sdk.PaRappa;

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
import org.apache.http.impl.cookie.BasicClientCookie;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONObject;

import android.app.Activity;
import android.content.Context;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.util.Log;
import android.webkit.CookieManager;
import android.webkit.CookieSyncManager;


public class ApiUtil {
	private static String TAG = ApiUtil.class.getName();

	public static boolean init(Activity activity, String userAgent, String jsonLog) {
        String appCode = MetaDataUtil.getMetaData(activity.getApplicationContext(), "PARAPPA_APP_CODE", "");
        if (appCode.equals("")) {
        	Log.w(TAG, "PARAPPA_APP_CODE required. define PARAPPA_APP_CODE in AndroidManifest.xml.");
        	return false;
        }
        final String domain = MetaDataUtil.getDomain(activity);

        DefaultHttpClient httpClient = preRequest(activity, userAgent, domain);
		HttpPost httppost = new HttpPost("http://" + domain + "/api/mobile_init.json/" + appCode);
		List<NameValuePair> nameValuePair = new ArrayList<NameValuePair>(3);
		nameValuePair.add(new BasicNameValuePair("activity", activity.getClass().getName()));
		nameValuePair.add(new BasicNameValuePair("log", jsonLog));
		nameValuePair.add(new BasicNameValuePair("version", PaRappa.PARAPPA_VERSION));
		nameValuePair.add(new BasicNameValuePair("app_version", String.valueOf(MetaDataUtil.getVersionCode(activity))));

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
			postRequest(activity, domain, httpClient);
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
        final String domain = MetaDataUtil.getDomain(context);

        DefaultHttpClient httpClient = preRequest(context, userAgent, domain);
		HttpGet get = new HttpGet(
				String.format("http://%s/api/notify.json/%s?activity=%s&version=%s&app_version=%d",
						domain, 
						appCode,
						context.getClass().getName(),
						PaRappa.PARAPPA_VERSION,
						MetaDataUtil.getVersionCode(context)));

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
				Log.d(TAG, "error: " + result.getString("error"));
				return null;
			} else if (!result.has("notify") || JSONObject.NULL.equals(result.get("notify"))) {
				Log.d(TAG, "notify dose not exist");
				return null;
			}
			JSONObject notifyJsono = result.getJSONObject("notify");
			notify = new Notify(
					notifyJsono.getString("subject"), 
					notifyJsono.getString("activity"), 
					appCode,
					notifyJsono.getString("appName"),
					notifyJsono.getInt("notify_id"));
			postRequest(context, domain, httpClient);
			return notify;
		} catch (Exception e) {
			Log.e(TAG, "http access error. " + e.getMessage());
			return null;
		}
	}

	public static App getApp(Context context, String userAgent) {
        String appCode = MetaDataUtil.getMetaData(context.getApplicationContext(), "PARAPPA_APP_CODE", "");
        if (appCode.equals("")) {
        	Log.w(TAG, "PARAPPA_APP_CODE required. define PARAPPA_APP_CODE in AndroidManifest.xml.");
        	return null;
        }
        final String domain = MetaDataUtil.getDomain(context);

        DefaultHttpClient httpClient = preRequest(context, userAgent, domain);
		HttpGet get = new HttpGet(
				String.format("http://%s/api/app.json?code=%s&activity=%s&version=%s&app_version=%s",
						domain, 
						appCode,
						context.getClass().getName(),
						PaRappa.PARAPPA_VERSION,
						MetaDataUtil.getVersionCode(context)));

		App app;
		try {
			Log.d(TAG, "get");
			HttpResponse response = httpClient.execute(get);
			Log.d(TAG, "got");
			ByteArrayOutputStream byteArrayOutputStream = new ByteArrayOutputStream();
			response.getEntity().writeTo(byteArrayOutputStream);
			Log.d(TAG, byteArrayOutputStream.toString());
			JSONObject result = new JSONObject(byteArrayOutputStream.toString());
			if (!result.has("error") || !JSONObject.NULL.equals(result.get("error"))) {
				Log.d(TAG, "error: " + result.getString("error"));
				return null;
			}
			JSONObject appJsono = result.getJSONObject("app");
			app = new App(appJsono.getString("url"));
			postRequest(context, domain, httpClient);
			return app;
		} catch (Exception e) {
			Log.e(TAG, "http access error. " + e.getMessage());
			return null;
		}
	}

	private static void postRequest(Context context, final String domain,
			DefaultHttpClient httpClient) {
		// HttpClientで得たCookieの情報をWebViewでも利用できるようにする
		CookieStore cookieStr = httpClient.getCookieStore();
		Cookie cookie = null;
		if ( cookieStr != null ) {
			List<Cookie> cookies = cookieStr.getCookies();
			if (!cookies.isEmpty()) {
				for (int i = 0; i < cookies.size(); i++) {
					cookie = cookies.get(i);
					Log.d(TAG, "cookie: " + cookie.getName() + " " + cookie.getValue());
					if (cookie.getName().equals(PaRappa.PARAPPA_ID_NAME) && cookie.getValue().length() > 0) {
						SharedPreferences settings = context
								.getSharedPreferences(PaRappa.PARAPPA_DEFAULT_DOMAIN, 0);
						SharedPreferences.Editor editor = settings.edit();
						editor.putString(PaRappa.PARAPPA_ID_NAME, cookie.getValue());
						Log.d(TAG, "***********************GOT " + cookie.getName() + " " + cookie.getValue());
						editor.commit();
					}
				}
			}
			//FIXME 最後のCookieの値だけしかCookieManagerに保存してない
			if (cookie != null) {
				String cookieString = cookie.getName() + "=" + cookie.getValue() + "; domain=" + cookie.getDomain();
				Log.d(TAG, "cookieString: " + cookieString);
				CookieManager.getInstance().setCookie(domain, cookieString);
				CookieSyncManager.getInstance().sync();
			}
		}
	}

	private static DefaultHttpClient preRequest(Context context,
			String userAgent, String domain) {
		final SharedPreferences settings = context
				.getSharedPreferences(PaRappa.PARAPPA_DEFAULT_DOMAIN, 0);
		final String parappaId = settings.getString(PaRappa.PARAPPA_ID_NAME, "");
		
		BasicClientCookie parappaIdCookie = new BasicClientCookie(
				PaRappa.PARAPPA_ID_NAME, parappaId);
		parappaIdCookie.setDomain(domain);
		parappaIdCookie.setPath("/");
		Log.d(TAG, "***********************STORED " + parappaIdCookie.getName() + " " + parappaIdCookie.getValue());

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
		CookieStore store = httpClient.getCookieStore();
		store.clear();
		store.addCookie(parappaIdCookie);
		return httpClient;
	}
	public static class Notify {
		public String activity;
		public String subject;
		public String appName;
		public String appCode;
		public int notifyId;
		public Notify(String subject, String activity, String appCode, String appName, int notifyId) {
			this.activity = activity;
			this.subject = subject;
			this.appCode = appCode;
			this.appName = appName;
			this.notifyId = notifyId;
		}
	}
	public static class App {
		public String url;
		public App(String url) {
			this.url = url;
		}
	}

	public static boolean isConnected(final Context context) {
		  ConnectivityManager connManager = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
		  final NetworkInfo networkInfo = connManager.getActiveNetworkInfo();
		  return (networkInfo != null && networkInfo.isConnected());
	}
	
	private static final Pattern packageName_ = Pattern.compile("[\\?&]id=([^&]+)");
	public static String getNativeMarketUrl(String url) {
		Matcher m = packageName_.matcher(url);
		if (!m.find()) {
			return url;
		}
		Log.d(TAG, m.group(1));
		return String.format("market://details?id=%s", m.group(1));
	}
}
