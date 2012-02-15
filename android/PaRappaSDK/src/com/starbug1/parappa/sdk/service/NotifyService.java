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

import com.starbug1.parappa.sdk.activity.NotifyActivity;
import com.starbug1.parappa.sdk.receiver.StartReceiver;

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
		// TODO PaRappa 通知すべきnotificationがあるかをチェックする。
		String json = "{\"notifyUrl\":\"http://parappa.starbug1.com/mobile/notify\", \"activity\":\"com.starbug1.parappa.sample.PaRappaSampleActivity\"}";
		Log.d(TAG, "checkNotify===============================================");
		NotificationManager manager = (NotificationManager) getSystemService(NOTIFICATION_SERVICE);
		Notification notification = new Notification(
				android.R.drawable.btn_star, "ニュースが入りました",
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
