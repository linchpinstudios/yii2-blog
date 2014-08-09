<?php

namespace app\widgets;

use linchpinstudios\blog\models\BlogPosts;
use yii\helpers\Html;
use yii\web\UrlManager;

class RecentBlogPostsTwoWidget extends \yii\base\Widget
{
	public function run()
	{
		if(isset(\Yii::$app->params['recentBlogPostsWidget']) && is_int(\Yii::$app->params['recentBlogPostsWidget'])) {
			$limit = \Yii::$app->params['recentBlogPostsWidget'];
		} else {
			$limit = 4;
		}

		$posts = BlogPosts::find()
				->orderBy('publishDate desc')
				->limit($limit)
				->all();

		if (empty($posts)) {
			echo '<p>No posts to display.</p>';
		} else {
			echo '<ul class="list-unstyled">' . $this->renderPosts($posts) . '</ul>';
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
	    $postRender = '<div class="col-md-3"><article>';
        $postRender .= Html::a('',['blogposts/view', 'id' => $post->id, 'urlSlug' => $post->urlSlug, 'year' => date('Y',strtotime($post->publishDate)), 'month' => date('m',strtotime($post->publishDate)), 'day' => date('d',strtotime($post->publishDate))],['class'=>'recentPostThumnail','style'=>'background-image:url('.$post->thumbnail.')']);
	    $postRender .= '<h4>' . Html::a(Html::encode($post->title), ['blogposts/view', 'id' => $post->id, 'urlSlug' => $post->urlSlug, 'year' => date('Y',strtotime($post->publishDate)), 'month' => date('m',strtotime($post->publishDate)), 'day' => date('d',strtotime($post->publishDate))]) . '</h4>';
	    $postRender .= '<p>'.$post->description.'</p>';
        $postRender .= '<p class="text-right">'.Html::a('Read Article',['blogposts/view', 'id' => $post->id, 'urlSlug' => $post->urlSlug, 'year' => date('Y',strtotime($post->publishDate)), 'month' => date('m',strtotime($post->publishDate)), 'day' => date('d',strtotime($post->publishDate))],['class'=>'btn btn-success btn-xs']).'</p>';
	    $postRender .= '</article></div>';
	
		return $postRender;
	}
}