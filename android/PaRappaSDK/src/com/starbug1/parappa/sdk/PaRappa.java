package com.starbug1.parappa.sdk;

import android.app.Activity;
import android.content.Intent;
import android.util.Log;
import android.webkit.WebView;

import com.starbug1.parappa.sdk.activity.SupportActivity;
import com.starbug1.parappa.sdk.util.ApiUtil;

public class PaRappa {
	private String TAG = PaRappa.class.getSimpleName();
	private Activity parent;
	private String userAgent = "";

	public PaRappa(Activity parent) {
		Log.d(TAG, "parappa create.");
		this.parent = parent;
		userAgent = new WebView(parent).getSettings().getUserAgentString();
		new Thread(new Runnable() {
			@Override
			public void run() {
				ApiUtil.init(PaRappa.this.parent, userAgent);
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
