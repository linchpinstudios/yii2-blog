<?php

namespace linchpinstudios\blog\widgets;

use linchpinstudios\blog\models\BlogTerms;
use yii\helpers\Html;
use yii\web\UrlManager;

class BlogCategoriesWidget extends \yii\base\Widget
{
	public function run()
	{

		$categories = BlogTerms::find()->with('blogTermRelationships')->orderBy(['name' => SORT_ASC])->all();

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
        $catRender .= Html::a($category->name.' ('.count($category->blogTermRelationships).')',['blogposts/category', 'id' => $category->id, 'category' => $category->name]);
        $catRender .= '</li>';
        
        return $catRender;	
	}
}