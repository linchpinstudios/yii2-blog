<?php

namespace linchpinstudios\blog\widgets;

use linchpinstudios\blog\models\BlogPosts;
use yii\helpers\Html;
use yii\web\UrlManager;

/**
 * @changed by Philipp Frenzel <philipp@frenzel.net>
 * @reason namespace not working like this
 * @reason fields are incorrect
 */

class RecentPosts extends \yii\base\Widget
{
	//@var \Closure an anonymous function with the signature `function ($posts)` which render post list
	public $render;

	public function run()
	{
		if(isset(\Yii::$app->params['recentBlogPostsWidget']) && is_int(\Yii::$app->params['recentBlogPostsWidget'])) {
			$limit = \Yii::$app->params['recentBlogPostsWidget'];
		} else {
			$limit = 4;
		}

		$posts = BlogPosts::find()
			->orderBy('date_gmt desc')
			->limit($limit)
			->all();

		if ($this->render instanceof \Closure) {
			call_user_func($this->render, $posts);
		} else {
			if (empty($posts)) {
				echo '<p>No posts to display.</p>';
			} else {
				echo '<ul class="list-unstyled">' . $this->renderPosts($posts) . '</ul>';
			}
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
		$postRender = '<div class="row"><article>';
		//$postRender .= Html::a('',['blogposts/view', 'id' => $post->id, 'urlSlug' => $post->urlSlug, 'year' => date('Y',strtotime($post->date_gmt)), 'month' => date('m',strtotime($post->date_gmt)), 'day' => date('d',strtotime($post->date_gmt))],['class'=>'recentPostThumnail','style'=>'background-image:url('.$post->thumbnail.')']);
		$postRender .= '<h4>' . Html::a(Html::encode($post->title), ['blogposts/view', 'id' => $post->id, 'year' => date('Y',strtotime($post->date_gmt)), 'month' => date('m',strtotime($post->date_gmt)), 'day' => date('d',strtotime($post->date_gmt))]) . '</h4>'; //'urlSlug' => $post->urlSlug
		$postRender .= '<p>'.$post->excerpt.'</p>';
		$postRender .= '<p class="text-right">'.Html::a('Read Article',['blogposts/view', 'id' => $post->id, 'year' => date('Y',strtotime($post->date_gmt)), 'month' => date('m',strtotime($post->date_gmt)), 'day' => date('d',strtotime($post->date_gmt))],['class'=>'btn btn-success btn-xs']).'</p>'; //, 'urlSlug' => $post->urlSlug
		$postRender .= '</article></div>';

		return $postRender;
	}
}
