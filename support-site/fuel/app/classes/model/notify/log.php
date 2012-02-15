<?php

class Model_Notify_Log extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'app_id',
		'notify_schedule_id',
		'locale',
		'notified_at',
		'created_at',
		'updated_at'
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);
}
