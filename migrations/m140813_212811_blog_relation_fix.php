<?php

use yii\db\Schema;
use yii\db\Migration;

class m140813_212811_blog_relation_fix extends Migration
{
    public function up()
    {
        $this->dropForeignKey('FK-termrelation-post-id','{{%blog_term_relationships}}');
        $this->addForeignKey('FK-termrelation-post-id','{{%blog_term_relationships}}','post_id','{{%blog_posts}}','id','NO ACTION','NO ACTION');

    }

    public function down()
    {

        return true;
    }
}
