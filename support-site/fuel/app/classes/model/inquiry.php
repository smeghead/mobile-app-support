<?php

class Model_Inquiry extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'user_id',
		'answer_to',
		'content',
		'status',
		'asked_at',
		'answered_at',
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
