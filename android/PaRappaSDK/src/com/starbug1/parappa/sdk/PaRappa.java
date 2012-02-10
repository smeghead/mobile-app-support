package com.starbug1.parappa.sdk;

import android.app.Activity;
import android.content.Intent;
import android.util.Log;

import com.starbug1.parappa.sdk.activity.SupportActivity;

public class PaRappa {
	private String TAG = PaRappa.class.getSimpleName();
	private Activity parent;
	public PaRappa(Activity parent) {
		Log.d(TAG, "parappa create.");
		this.parent = parent;
	}
	
	public void startSupportActivity() {
		Log.d(TAG, "parappa startSupportActivity.");
		Intent intent = new Intent(this.parent, SupportActivity.class);
		intent.putExtra("parentActivity", parent.getClass().getName());
		this.parent.startActivity(intent);
	}
	
}
