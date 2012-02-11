package com.starbug1.parappa.sdk.util;

import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.content.SharedPreferences;
import android.content.SharedPreferences.Editor;
import android.preference.PreferenceManager;
import android.util.Log;

public class PreferenceUtil {
	private static String TAG = PreferenceUtil.class.getName();
	
	public static JSONObject get(Activity parent) {
		SharedPreferences sharedPreferences = PreferenceManager.getDefaultSharedPreferences(parent);
		String logString = sharedPreferences.getString("PARRAPA_LOG", "");
		JSONObject log = null;
		try {
			if (logString != "") {
				log = new JSONObject(logString);
			}
		} catch (JSONException e) {
			Log.e(TAG, "JSON parse error. " + e.getMessage());
		}
		if (log == null) {
			log = new JSONObject();
		}
		return log;
	}
	
	public static void save(Activity parent) {
		JSONObject log = get(parent);
		final String activityName = parent.getClass().getName();
		try {
			if (log.has(activityName)) {
				log.put(activityName, log.getInt(activityName) + 1);
			} else {
				log.put(activityName, 1);
			}
			String logString = log.toString();
			SharedPreferences sp = PreferenceManager.getDefaultSharedPreferences(parent);
			Editor ed = sp.edit();
			ed.putString("PARRAPA_LOG", logString);
			ed.commit();
		} catch (JSONException e) {
			Log.e(TAG, "JSON save error. " + e.getMessage());
		}
	}
	
	public static void clear(Activity parent) {
		SharedPreferences sp = PreferenceManager.getDefaultSharedPreferences(parent);
		Editor ed = sp.edit();
		ed.putString("PARRAPA_LOG", "");
		ed.commit();
	}
}
