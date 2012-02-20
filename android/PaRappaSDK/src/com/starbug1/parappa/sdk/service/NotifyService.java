package com.starbug1.parappa.sdk.service;

import java.util.GregorianCalendar;

import android.app.AlarmManager;
import android.app.Notification;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.app.Service;
import android.content.Context;
import android.content.Intent;
import android.os.IBinder;
import android.util.Log;
import android.webkit.WebView;

import com.starbug1.parappa.sdk.activity.NotifyActivity;
import com.starbug1.parappa.sdk.receiver.StartReceiver;
import com.starbug1.parappa.sdk.util.ApiUtil;

public class NotifyService extends Service {
	private static String TAG = NotifyService.class.getName();

	@Override
	public IBinder onBind(Intent intent) {
		return null;
	}

	@Override
	public void onCreate() {
		AlarmManager alarmManager = (AlarmManager) getSystemService(Context.ALARM_SERVICE);
		Intent alarmIntent = new Intent(this, StartReceiver.class);
		PendingIntent sender = PendingIntent.getBroadcast(this, 0, alarmIntent,
				0);
		GregorianCalendar calendar = new GregorianCalendar();
		alarmManager.setInexactRepeating(AlarmManager.RTC_WAKEUP,
				calendar.getTimeInMillis() + 1000 * 60, 1000 * 60 * 5, sender);
		super.onCreate();
	}

	public void onStart(Intent intent, int startId) {
		Log.d(TAG, "onStart");

		new Thread(new Runnable() {
			@Override
			public void run() {
				checkNotify();
			}
		}).start();

		super.onStart(intent, startId);
	}

	private void checkNotify() {
		// PaRappa 通知すべきnotificationがあるかをチェックする。
		String userAgent = new WebView(this).getSettings().getUserAgentString();
		ApiUtil.Notify notify = ApiUtil.getNotify(this, userAgent);
		if (notify == null) {
			Log.d(TAG, "no notifies.");
			return;
		}
		String json = "{\"notifyUrl\": \"/mobile/notify/" + notify.appCode + "/" + notify.notifyId + "\", \"activity\":\"" + notify.activity + "\", \"notify_id\": " + notify.notifyId + "}";
		Log.d(TAG, "checkNotify===============================================");
		NotificationManager manager = (NotificationManager) getSystemService(NOTIFICATION_SERVICE);
		Notification notification = new Notification(
				android.R.drawable.btn_star, notify.subject,
				System.currentTimeMillis());

		Intent intent = new Intent(NotifyService.this, NotifyActivity.class);
		intent.putExtra("notifyJson", json);
		PendingIntent contentIntent = PendingIntent.getActivity(
				NotifyService.this, 0, intent, 0);
		notification.setLatestEventInfo(getApplicationContext(), "parappa",
				"notify.....", contentIntent);
		manager.notify(9999, notification); // FIXME
	}
}
