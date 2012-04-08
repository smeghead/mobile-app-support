package me.parappa.sample;

import me.parappa.sdk.PaRappa;
import android.app.Activity;
import android.os.Bundle;
import android.view.MenuInflater;
import android.view.MenuItem;


public class PaRappaSampleActivity extends Activity {
	/** PaRappa instance. **/
	private PaRappa parappa;
	
    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.main);
        // create PaRappa instance.
        parappa = new PaRappa(this);
    }

    @Override
    public boolean onCreateOptionsMenu(android.view.Menu menu) {
    	super.onCreateOptionsMenu(menu);
    	MenuInflater inflater = getMenuInflater();
    	inflater.inflate(R.menu.main_menu, menu);
    	return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
    	switch (item.getItemId()) {
		case R.id.menu_support:
			// open PaRappa suport activity feature.
			parappa.startSupportActivity();
			break;
		}
    	return true;
    }
}