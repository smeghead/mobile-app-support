<?php

class Model_Inquiry_Message extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'inquiry_base_id',
		'email',
		'content',
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
