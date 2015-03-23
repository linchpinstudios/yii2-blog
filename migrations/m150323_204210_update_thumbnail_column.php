<?php

use yii\db\Schema;
use yii\db\Migration;

class m150323_204210_update_thumbnail_column extends Migration
{
    public function up()
    {

        $this->alterColumn( '{{%blog_posts}}', 'thumbnail', Schema::TYPE_INTEGER);

    }

    public function down()
    {

        $this->alterColumn( '{{%blog_posts}}', 'thumbnail', Schema::TYPE_STRING . '(555)');

    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
