<?php

namespace linchpinstudios\blog\models;

use Yii;

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
            [['description'], 'string'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 20]
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
     * @return \yii\db\ActiveQuery
     */
    public function getBlogTermRelationships()
    {
        return $this->hasMany(BlogTermRelationships::className(), ['post_id' => 'id']);
    }
    
    
    
}
