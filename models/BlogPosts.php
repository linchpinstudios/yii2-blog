<?php

namespace linchpinstudios\blog\models;

use Yii;
use common\models\User;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use linchpinstudios\blog\models\BlogTermRelationships;

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


    public function behaviors()
    {
        return [

            'modified' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'modified',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'modified',
                ],
                'value' => function() {
                    return date('Y-m-d H:i:s');
                },
            ],
            'modifiedGMT' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'modified_gmt',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'modified_gmt',
                ],
                'value' => function() {
                    return gmdate('Y-m-d H:i:s');
                },
            ],
            'date' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'date',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'date',
                ],
                'value' => function() {
                    return (empty($this->date) ? date('Y-m-d H:i:s') : date('Y-m-d H:i:s',strtotime($this->date)));
                },
            ],
            'dateGMT' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'date_gmt',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'date_gmt',
                ],
                'value' => function() {
                    return (empty($this->date) ? gmdate('Y-m-d H:i:s') : gmdate('Y-m-d H:i:s',strtotime($this->date)));
                },
            ],
            'slug' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'slug',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'slug',
                ],
                'value' => function() {
                    return (empty($this->slug) ? $this->genSlug($this->title) : $this->genSlug($this->slug));
                },
            ],
        ];
    }

    public static function genSlug($str, $replace=array(), $delimiter='-'){
    	if( !empty($replace) ) {
    		$str = str_replace((array)$replace, ' ', $str);
    	}

    	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
    	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
    	$clean = strtolower(trim($clean, '-'));
    	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

    	return $clean;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blog_posts}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'comments', 'thumbnail'], 'integer'],
            [['body', 'excerpt'], 'string'],
            [['date', 'date_gmt', 'modified', 'modified_gmt'], 'safe'],
            [['title'], 'string', 'max' => 555],
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
    public function getTerms()
    {
        return $this->hasMany(BlogTermRelationships::className(), ['post_id' => 'id']);
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
