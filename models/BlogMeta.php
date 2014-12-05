<?php

namespace linchpinstudios\blog\models;

use Yii;

/**
 * This is the model class for table "blog_meta".
 *
 * @property integer $id
 * @property integer $post_id
 * @property string $type
 * @property string $name
 * @property string $value
 *
 * @property BlogPosts $post
 */
class BlogMeta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blog_meta}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id'], 'integer'],
            [['value'], 'string'],
            [['type'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'type' => 'Type',
            'name' => 'Name',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(BlogPosts::className(), ['id' => 'post_id']);
    }
}
