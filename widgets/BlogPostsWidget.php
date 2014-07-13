<?php

namespace linchpinstudios\blog;

use linchpinstudios\blog\models\BlogPosts;
use yii\helpers\Html;
use yii\web\UrlManager;

class BlogPostsWidget extends \yii\base\Widget
{

    public $limit = 5;
    public $orderBy = 'date';
    public $orderDirection = 'desc';
    public $where = '';
    public $posts;

	public function run()
	{
	
        if(empty($this->posts)){
		    $this->posts = BlogPosts::find()
				->orderBy($this->orderBy.' '.$this->orderDirection)
				->limit($this->limit)
				->all();
        }

		if (empty($this->posts)) {
			echo '<p>No posts to display.</p>';
		} else {
			echo '<ul class="list-unstyled">' . $this->renderPosts($this->posts) . '</ul>';
		}
	}

	public function renderPosts($posts)
	{
		$items = [];
		foreach ($posts as $post) {
			$items[] = $this->renderPost($post);
		}

		return implode("\n", $items);
	}

	public function renderPost($post)
	{
	
	    $postRender = '<div class="post">';
            $postRender .= Html::tag('h1',Html::a($post->title,['blog/blogposts/view']));
	    $postRender .= '</div>';
	
	
	    /*$postRender = '<div class="row"><article><div class="col-md-4">';
        $postRender .= Html::a('',['blogposts/view', 'id' => $post->id, 'urlSlug' => $post->slug, 'year' => date('Y',strtotime($post->publishDate)), 'month' => date('m',strtotime($post->publishDate)), 'day' => date('d',strtotime($post->publishDate))],['class'=>'recentPostThumnail','style'=>'background-image:url('.$post->thumbnail.')']);
        $postRender .= '</div><div class="col-md-8">';
	    $postRender .= '<h3 style="margin-top:0;">' . Html::a(Html::encode($post->title), ['blogposts/view', 'id' => $post->id, 'urlSlug' => $post->urlSlug, 'year' => date('Y',strtotime($post->publishDate)), 'month' => date('m',strtotime($post->publishDate)), 'day' => date('d',strtotime($post->publishDate))]) . '</h3>';
	    $postRender .= '
	        <ul class="list-inline">
	            <li><i class="glyphicon glyphicon-calendar"></i> '.date('M d, Y',strtotime($post->publishDate)).'</li>
	            <li><i class="glyphicon glyphicon-user"></i> '.$post->author->username.'</li>
	            <li><i class="glyphicon glyphicon-folder-close"></i> '.$post->category->category.'</li>
	            <li><i class="glyphicon glyphicon-comment"></i> Comments</li>
	        </ul>';
	    $postRender .= '<p>'.$post->description.'</p>';
        $postRender .= Html::a('Read Article',['blogposts/view', 'id' => $post->id, 'urlSlug' => $post->urlSlug, 'year' => date('Y',strtotime($post->publishDate)), 'month' => date('m',strtotime($post->publishDate)), 'day' => date('d',strtotime($post->publishDate))],['class'=>'btn btn-success btn-xs pull-right']);
	    $postRender .= '</div></article></div>';
        $postRender .= '<hr />';*/
		return $postRender;
	}
}