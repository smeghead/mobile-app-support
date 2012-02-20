<?php

namespace Fuel\Migrations;

class Create_app_categories
{
  public function up()
  {
    \DBUtil::create_table('app_categories', array(
      'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
      'category_code' => array('constraint' => 11, 'type' => 'int'),
      'locale' => array('constraint' => 2, 'type' => 'varchar'),
      'name' => array('constraint' => 64, 'type' => 'varchar'),
      'created_at' => array('constraint' => 11, 'type' => 'int'),
      'updated_at' => array('constraint' => 11, 'type' => 'int'),
    ), array('id'));
    \DB::insert('app_categories')->set(array('category_code' => 1, 'locale' => 'ja', 'name' => 'アート＆エンターテイメント', 'created_at' => time(), 'updated_at' => time()))->execute();
    \DB::insert('app_categories')->set(array('category_code' => 2, 'locale' => 'ja', 'name' => '自動車', 'created_at' => time(), 'updated_at' => time()))->execute();
    \DB::insert('app_categories')->set(array('category_code' => 3, 'locale' => 'ja', 'name' => 'ビジネス', 'created_at' => time(), 'updated_at' => time()))->execute();
    \DB::insert('app_categories')->set(array('category_code' => 4, 'locale' => 'ja', 'name' => '採用情報', 'created_at' => time(), 'updated_at' => time()))->execute();
    \DB::insert('app_categories')->set(array('category_code' => 5, 'locale' => 'ja', 'name' => '教育', 'created_at' => time(), 'updated_at' => time()))->execute();
    \DB::insert('app_categories')->set(array('category_code' => 6, 'locale' => 'ja', 'name' => '家族＆子育て', 'created_at' => time(), 'updated_at' => time()))->execute();
    \DB::insert('app_categories')->set(array('category_code' => 7, 'locale' => 'ja', 'name' => 'ヘルス＆フィットネス', 'created_at' => time(), 'updated_at' => time()))->execute();
    \DB::insert('app_categories')->set(array('category_code' => 8, 'locale' => 'ja', 'name' => 'フード＆ドリンク', 'created_at' => time(), 'updated_at' => time()))->execute();
    \DB::insert('app_categories')->set(array('category_code' => 9, 'locale' => 'ja', 'name' => '趣味＆ゲーム＆コミック', 'created_at' => time(), 'updated_at' => time()))->execute();
    \DB::insert('app_categories')->set(array('category_code' => 10, 'locale' => 'ja', 'name' => 'ホーム＆ガーデン', 'created_at' => time(), 'updated_at' => time()))->execute();
    \DB::insert('app_categories')->set(array('category_code' => 11, 'locale' => 'ja', 'name' => '法律＆政治', 'created_at' => time(), 'updated_at' => time()))->execute();
    \DB::insert('app_categories')->set(array('category_code' => 12, 'locale' => 'ja', 'name' => 'ニュース', 'created_at' => time(), 'updated_at' => time()))->execute();
    \DB::insert('app_categories')->set(array('category_code' => 13, 'locale' => 'ja', 'name' => '個人ファイナンス', 'created_at' => time(), 'updated_at' => time()))->execute();
    \DB::insert('app_categories')->set(array('category_code' => 14, 'locale' => 'ja', 'name' => '学会', 'created_at' => time(), 'updated_at' => time()))->execute();
    \DB::insert('app_categories')->set(array('category_code' => 15, 'locale' => 'ja', 'name' => 'サイエンス', 'created_at' => time(), 'updated_at' => time()))->execute();
    \DB::insert('app_categories')->set(array('category_code' => 16, 'locale' => 'ja', 'name' => 'ペット', 'created_at' => time(), 'updated_at' => time()))->execute();
    \DB::insert('app_categories')->set(array('category_code' => 17, 'locale' => 'ja', 'name' => 'スポーツ', 'created_at' => time(), 'updated_at' => time()))->execute();
    \DB::insert('app_categories')->set(array('category_code' => 18, 'locale' => 'ja', 'name' => 'スタイル＆ファッション', 'created_at' => time(), 'updated_at' => time()))->execute();
    \DB::insert('app_categories')->set(array('category_code' => 19, 'locale' => 'ja', 'name' => 'テクノロジー＆コンピューティング', 'created_at' => time(), 'updated_at' => time()))->execute();
    \DB::insert('app_categories')->set(array('category_code' => 20, 'locale' => 'ja', 'name' => 'トラベル', 'created_at' => time(), 'updated_at' => time()))->execute();
    \DB::insert('app_categories')->set(array('category_code' => 21, 'locale' => 'ja', 'name' => '不動産', 'created_at' => time(), 'updated_at' => time()))->execute();
    \DB::insert('app_categories')->set(array('category_code' => 22, 'locale' => 'ja', 'name' => 'ショッピング', 'created_at' => time(), 'updated_at' => time()))->execute();
    \DB::insert('app_categories')->set(array('category_code' => 23, 'locale' => 'ja', 'name' => '宗教＆精神世界', 'created_at' => time(), 'updated_at' => time()))->execute();
  }

  public function down()
  {
    \DBUtil::drop_table('app_categories');
  }
}
