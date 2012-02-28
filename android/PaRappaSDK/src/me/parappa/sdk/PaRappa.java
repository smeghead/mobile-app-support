package me.parappa.sdk;

import me.parappa.sdk.activity.SupportActivity;
import me.parappa.sdk.util.ApiUtil;
import me.parappa.sdk.util.PreferenceUtil;

import org.json.JSONObject;

import android.app.Activity;
import android.content.Intent;
import android.util.Log;
import android.webkit.WebView;


public class PaRappa {
	public static final String PARAPPA_DOMAIN = "parappa.starbug1.com";
	public static final String PARAPPA_ID_NAME = "_PARAPPA_ID";
	private String TAG = PaRappa.class.getSimpleName();
	private Activity parent;
	private String userAgent = "";

	public PaRappa(Activity parent) {
		Log.d(TAG, "parappa create.");
		this.parent = parent;
		if (!ApiUtil.isConnected(parent)) {
			//  ネットワークが無い場合、保存するだけにする。
			PreferenceUtil.save(parent);
			return;
		}
		userAgent = new WebView(parent).getSettings().getUserAgentString();
		new Thread(new Runnable() {
			@Override
			public void run() {
				JSONObject log = PreferenceUtil.get(PaRappa.this.parent);
				if (ApiUtil.init(PaRappa.this.parent, userAgent, log.toString())) {
					//logのクリア
					PreferenceUtil.clear(PaRappa.this.parent);
				} else {
					// 失敗した場合は保存する。
					PreferenceUtil.save(PaRappa.this.parent);
				}
			}
		}).start();
	}
	
	public void startSupportActivity() {
		Log.d(TAG, "parappa startSupportActivity.");
		Intent intent = new Intent(this.parent, SupportActivity.class);
		intent.putExtra("parentActivity", parent.getClass().getName());
		this.parent.startActivity(intent);
	}
	
}
