<?php

namespace linchpinstudios\blog\widgets;

use linchpinstudios\blog\models\BlogCategories;
use yii\helpers\Html;
use yii\web\UrlManager;

class BlogCategoriesWidget extends \yii\base\Widget
{
	public function run()
	{

		$categories = BlogCategories::find()->with('blogPostsCount')->orderBy('category asc')->all();

		if (empty($categories)) {
		    echo '<h3>Categories</h3>';
			echo '<p>No categories to display.</p>';
		} else {
		    echo '<h3>Categories</h3>';
			echo '<ul class="list-unstyled">' . $this->renderCategories($categories) . '</ul>';
		}
	}
	
	public function renderCategories($categories){
    	
    	$items = [];
    	
    	foreach($categories as $category){
        	$items[] = $this->renderCategory($category);
    	}
    	
    	return implode("\n", $items); 
	}
	
	public function renderCategory($category){
        
        $catRender = '<li>';
        $catRender .= Html::a($category->category.' ('.count($category->blogPostsCount).')',['blogposts/category', 'id' => $category->id, 'category' => $category->category]);
        $catRender .= '</li>';
        
        return $catRender;	
	}
}