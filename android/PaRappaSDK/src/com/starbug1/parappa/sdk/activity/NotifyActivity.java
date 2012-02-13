package com.starbug1.parappa.sdk.activity;

import android.app.Activity;
import android.app.NotificationManager;
import android.os.Bundle;
import android.util.Log;

import com.starbug1.parappa.sdk.util.ReflectionUtil;

public class NotifyActivity extends Activity {
	private String TAG = NotifyActivity.class.getName();

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		
		String className = "com.starbug1.parappa.sample.PaRappaSampleActivity";
		Class<Activity> clazz = ReflectionUtil.getClass(className);
		if (clazz == null) {
			Log.e(TAG, "Activity class name is invalid.");
			return;
		}
		
        NotificationManager manager = (NotificationManager) getSystemService(NOTIFICATION_SERVICE);
        manager.cancelAll();
    }
}
