<?php

namespace linchpinstudios\blog\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
use linchpinstudios\blog\models\BlogTermsQuery;
use linchpinstudios\blog\models\BlogPosts;
use linchpinstudios\blog\models\BlogTermRelationships;

/**
 * This is the model class for table "blog_terms".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $type
 *
 * @property BlogTermRelationships[] $blogTermRelationships
 */
class BlogTerms extends \yii\db\ActiveRecord
{


    public function behaviors()
    {
        return [
            'slug' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'slug',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'slug',
                ],
                'value' => function() { 
                    return (empty($this->slug) ? urlencode(str_replace(" ", "-", strtolower($this->name))) : urlencode(str_replace(" ", "-", strtolower($this->slug))));
                },
            ],
        ];
    }
    
    
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_terms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'unique', 'targetAttribute' => ['name', 'type']],
            [['description'], 'string'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 20],
            [['type','name'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'description' => 'Description',
            'type' => 'Type',
        ];
    }
    

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return new BlogTermsQuery(get_called_class());
    }
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogTermRelationships()
    {
        return $this->hasMany(BlogTermRelationships::className(), ['term_id' => 'id']);
    }
    
    
    public function getPosts()
    {
        return $this->hasMany(BlogPosts::className(), ['term_id' => 'id'])->viaTable('{{%blog_term_relationships}}', ['post_id' => 'id']);
    }
    
    
    
}
