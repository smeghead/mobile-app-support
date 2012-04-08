package me.parappa.sdk.util;

import me.parappa.sdk.PaRappa;
import android.content.Context;
import android.content.pm.ApplicationInfo;
import android.content.pm.PackageInfo;
import android.content.pm.PackageManager;
import android.content.pm.PackageManager.NameNotFoundException;
import android.util.Log;


public class MetaDataUtil {
	private static String TAG = MetaDataUtil.class.getName();
	
    public static String getMetaData(Context context, String name, String defaultValue) {
        ApplicationInfo info = null;
		try {
			info = context.getPackageManager().getApplicationInfo(context.getPackageName(), 
					PackageManager.GET_META_DATA); 
		} catch (NameNotFoundException e) {
			Log.e(TAG, "failed to get meta-data. " + e.getMessage());
		}
		if (info == null || info.metaData == null) {
			Log.e(TAG, "PARAPPA_APP_CODE is REQUIRED in AndroidManifest.xml.");
			return defaultValue;
		}
		if (info.metaData.containsKey(name)) {
	        return info.metaData.getString(name);
		} else {
			return defaultValue;
		}
    }

    public static String getDomain(Context context) {
        return MetaDataUtil.getMetaData(context, "PARAPPA_DOMAIN", PaRappa.PARAPPA_DEFAULT_DOMAIN);
    }

    public static int getVersionCode(Context context) {
    	try {
    		String packageName = context.getPackageName();
    		PackageInfo packageInfo = context.getPackageManager().getPackageInfo(packageName, PackageManager.GET_META_DATA);
    		return packageInfo.versionCode;
    	} catch (NameNotFoundException e) {
    		Log.e(TAG, "failed to get version code.");
    		return 0;
    	}
    }
}
