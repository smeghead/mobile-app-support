package com.starbug1.parappa.sdk.exception;

public class PaRappaException extends RuntimeException {
	private static final long serialVersionUID = 1L;

	public PaRappaException() {
	}

	public PaRappaException(String detailMessage) {
		super(detailMessage);
	}

	public PaRappaException(Throwable throwable) {
		super(throwable);
	}

	public PaRappaException(String detailMessage, Throwable throwable) {
		super(detailMessage, throwable);
	}

}
