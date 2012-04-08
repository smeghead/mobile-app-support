package me.parappa.sdk.service;

import java.util.GregorianCalendar;

import me.parappa.sdk.activity.NotifyActivity;
import me.parappa.sdk.receiver.StartReceiver;
import me.parappa.sdk.util.ApiUtil;

import android.app.AlarmManager;
import android.app.Notification;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.app.Service;
import android.content.Context;
import android.content.Intent;
import android.os.Handler;
import android.os.IBinder;
import android.util.Log;
import android.webkit.WebView;


public class NotifyService extends Service {
	private static String TAG = NotifyService.class.getName();
	private Handler handler_ = new Handler();

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
				calendar.getTimeInMillis() + 1000 * 60, 1000 * 60 * 5 /*60*/, sender);
		super.onCreate();
	}

	public void onStart(Intent intent, int startId) {
		Log.d(TAG, "******** parapaa notify service onStart");

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
		handler_.post(new Runnable() {
			@Override
			public void run() {
				Log.d(TAG, "******** check notifies.");
				//WebViewアクセスだけは、UIスレッドでおこなう。
				final String userAgent = new WebView(NotifyService.this).getSettings().getUserAgentString();
				//その後は、別スレッドで。
				new Thread(new Runnable() {
					@Override
					public void run() {
						ApiUtil.Notify notify = ApiUtil.getNotify(NotifyService.this, userAgent);
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
						notification.setLatestEventInfo(getApplicationContext(), notify.appName,
								notify.subject, contentIntent);
						manager.notify(9999, notification); // FIXME
					}
				}).start();
			}
		});
	}
}
