package com.starbug1.parappa.sdk.util;

public class ReflectionUtil {
	@SuppressWarnings("unchecked")
	public static <T> Class<T> getClass(String name) {
        try {
    		return (Class<T>) Class.forName(name);
    	} catch (ClassNotFoundException e) {
    		return null;
    	}
	}
}
