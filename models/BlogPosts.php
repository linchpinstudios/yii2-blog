<?php

namespace linchpinstudios\blog\models;

use Yii;
use common\models\User;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "blog_posts".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $comments
 * @property string $title
 * @property string $body
 * @property string $thumbnail
 * @property string $excerpt
 * @property string $status
 * @property string $slug
 * @property string $date
 * @property string $date_gmt
 * @property string $modified
 * @property string $modified_gmt
 *
 * @property BlogComments[] $blogComments
 * @property BlogPostTags[] $blogPostTags
 * @property User $author
 * @property BlogCategories $category
 * @property BlogMeta[] $blogMetas
 * @property User $user
 */
class BlogPosts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'comments'], 'integer'],
            [['body', 'excerpt'], 'string'],
            [['date', 'date_gmt', 'modified', 'modified_gmt'], 'safe'],
            [['title', 'thumbnail'], 'string', 'max' => 555],
            [['status'], 'string', 'max' => 20],
            [['slug'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'comments' => 'Comments',
            'title' => 'Title',
            'body' => 'Body',
            'thumbnail' => 'Thumbnail',
            'excerpt' => 'Excerpt',
            'status' => 'Status',
            'slug' => 'Slug',
            'date' => 'Date',
            'date_gmt' => 'Date Gmt',
            'modified' => 'Modified',
            'modified_gmt' => 'Modified Gmt',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogComments()
    {
        return $this->hasMany(BlogComments::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogPostTags()
    {
        return $this->hasMany(BlogPostTags::className(), ['postId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'authorId']);
    }
    
    public function getAuthorList()
    {
        $model = User::find()->asArray()->all();
        return ArrayHelper::map($model, 'id', 'username');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(BlogCategories::className(), ['id' => 'categoryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogMetas()
    {
        return $this->hasMany(BlogMeta::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
