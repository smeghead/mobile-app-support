<?php

namespace Fuel\Migrations;

class Create_faq_questions
{
	public function up()
	{
		\DBUtil::create_table('faq_questions', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'category_id' => array('constraint' => 11, 'type' => 'int'),
			'question' => array('type' => 'text'),
			'answer' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('faq_questions');
	}
}