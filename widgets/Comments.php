<?php

namespace linchpinstudios\blog\widgets;

use yii\helpers\Html;
use yii\web\UrlManager;
use yii\widgets\ActiveForm;
use linchpinstudios\blog\models\BlogComments;

class Comments extends \yii\base\Widget
{
    
    
    public $id = 0;
    
    public $orderDirection = 'ASC';
    

	public function run()
	{
	
        if($this->id == 0){
            return;
        }
        
        $model = new BlogComments;
        
		$comments = BlogComments::find()
			->orderBy('date_gmt '.$this->orderDirection)
			->where('post_id = :id', ['id' => $this->id])
			->all();
			
        return $this->render('comment',['model' => $model, 'comments' => $comments, 'id' => $this->id]);
        
	}
    
    
}