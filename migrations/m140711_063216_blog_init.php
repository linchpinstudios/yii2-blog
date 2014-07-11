<?php

use yii\db\Schema;

class m140711_063216_blog_init extends \yii\db\Migration
{
    public function safeup()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
    
        $this->createTable('{{%blog_posts}}',[
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER,
            'comments' => Schema::TYPE_BOOLEAN,
            'title' => Schema::TYPE_STRING . '(555)',
            'body' => Schema::TYPE_TEXT,
            'thumbnail' => Schema::TYPE_STRING . '(555)',
            'excerpt' => Schema::TYPE_TEXT,
            'status' => Schema::TYPE_STRING . '(20)',
            'slug' => Schema::TYPE_STRING . '(45)',
            'date' => Schema::TYPE_DATETIME,
            'date_gmt' => Schema::TYPE_DATETIME,
            'modified' => Schema::TYPE_DATETIME,
            'modified_gmt' => Schema::TYPE_DATETIME,
        ],$tableOptions);
        
        $this->createTable('{{%blog_comments}}',[
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER,
            'post_id' => Schema::TYPE_INTEGER,
            'comment' => Schema::TYPE_TEXT,
            'approved' => Schema::TYPE_STRING . '(20) NULL',
            'parent' => Schema::TYPE_INTEGER,
            'author_name' => Schema::TYPE_STRING . '(255) NULL',
            'author_email' => Schema::TYPE_STRING . '(255) NULL',
            'author_url' => Schema::TYPE_STRING . '(255) NULL',
            'author_ip' => Schema::TYPE_STRING . '(255) NULL',
            'notify_reply' => Schema::TYPE_BOOLEAN,
            'notify_comments' => Schema::TYPE_BOOLEAN,
            'date' => Schema::TYPE_DATETIME,
            'date_gmt' => Schema::TYPE_DATETIME,
        ],$tableOptions);
        
        $this->createTable('{{%blog_meta}}',[
            'id' => Schema::TYPE_PK,
            'post_id' => Schema::TYPE_INTEGER,
            'type' => Schema::TYPE_STRING . '(20) NULL',
            'name' => Schema::TYPE_STRING . '(255) NULL',
            'value' => Schema::TYPE_TEXT,
        ],$tableOptions);
        
        $this->createTable('{{%blog_term_relationships}}',[
            'id' => Schema::TYPE_PK,
            'post_id' => Schema::TYPE_INTEGER,
            'term_id' => Schema::TYPE_INTEGER,
        ],$tableOptions);
        
        $this->createTable('{{%blog_terms}}',[
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(255) NULL',
            'slug' => Schema::TYPE_STRING . '(255) NULL',
            'description' => Schema::TYPE_TEXT,
            'type' => Schema::TYPE_STRING . '(20) NULL',
        ],$tableOptions);
        
        $this->addForeignKey('FK-psots-user.id','{{%blog_posts}}','user_id','{{%user}}','id','NO ACTION','NO ACTION');
        $this->addForeignKey('FK-comments-user.id','{{%blog_comments}}','user_id','{{%user}}','id','NO ACTION','NO ACTION');
        $this->addForeignKey('FK-comments-post.id','{{%blog_comments}}','post_id','{{%blog_posts}}','id','NO ACTION','NO ACTION');
        $this->addForeignKey('FK-meta-post.id','{{%blog_meta}}','post_id','{{%blog_posts}}','id','NO ACTION','NO ACTION');
        $this->addForeignKey('FK-termrelation-post.id','{{%blog_term_relationships}}','post_id','{{%blog_terms}}','id','NO ACTION','NO ACTION');
        $this->addForeignKey('FK-termrelation-term.id','{{%blog_term_relationships}}','term_id','{{%blog_terms}}','id','NO ACTION','NO ACTION');

    }

    public function safedown()
    {
        
        $this->dropTable('{{%blog_posts}}');
        $this->dropTable('{{%blog_comments}}');
        $this->dropTable('{{%blog_meta}}');
        $this->dropTable('{{%blog_term_relationships}}');
        $this->dropTable('{{%blog_terms}}');

        return false;
    }
}
