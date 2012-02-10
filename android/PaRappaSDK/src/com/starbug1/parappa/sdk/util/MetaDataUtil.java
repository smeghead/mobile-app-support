package com.starbug1.parappa.sdk.util;

import android.content.Context;
import android.content.pm.ApplicationInfo;
import android.content.pm.PackageManager;
import android.content.pm.PackageManager.NameNotFoundException;
import android.util.Log;

public class MetaDataUtil {
	private static String TAG = MetaDataUtil.class.getName();
	
    public static String getMetaData(Context context, String name) {
        ApplicationInfo info = null;
		try {
			info = context.getPackageManager().getApplicationInfo(context.getPackageName(), 
					PackageManager.GET_META_DATA); 
		} catch (NameNotFoundException e) {
			Log.e(TAG, "failed to get meta-data. " + e.getMessage());
		}
		if (info == null || info.metaData == null) {
			Log.e(TAG, "PARAPPA_APP_CODE is REQUIRED in AndroidManifest.xml.");
			return "";
		}
        return info.metaData.getString(name);
    }


}
