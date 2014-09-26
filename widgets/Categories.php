<?php

namespace linchpinstudios\blog\widgets;

use linchpinstudios\blog\models\BlogTerms;
use yii\helpers\Html;
use yii\web\UrlManager;

class Categories extends \yii\base\Widget
{
	public function run()
	{

		$model = BlogTerms::find()->orderBy('name')->all();

        return $this->render('categories',['model' => $model,]);
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