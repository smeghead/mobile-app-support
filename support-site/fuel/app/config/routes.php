<?php
return array(
	'_root_'  => 'public/index',  // The default route
	'_404_'   => 'public/404',    // The main 404 route
	
	'hello(/:name)?' => array('mobile/hello', 'name' => 'hello'),
);
