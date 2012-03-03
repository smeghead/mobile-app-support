package me.parappa.sdk.receiver;

import me.parappa.sdk.service.NotifyService;

import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.util.Log;

public class StartReceiver extends BroadcastReceiver {
	private static String TAG = StartReceiver.class.getName();

	@Override
	public void onReceive(Context context, Intent intent) {
		Log.d(TAG, "onReceive!!!!!!!!!!!!!!!!!");
        Intent i = new Intent(context, NotifyService.class);
        context.startService(i);
	}

}
