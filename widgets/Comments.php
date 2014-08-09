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
			->all();
			
        return $this->render('comment',['model' => $model, 'comments' => $comments]);
	}
    
    
    
    
    public function renderForm()
    {
        
        $model = new BlogComments;
        
        $html = '<div class="well">';
            $form = ActiveForm::begin([
                'enableAjaxValidation'      => true,
                'enableClientValidation'    => true,
            ]);
                $html .= '<h4>Leave a Comments</h4>';
                
                $html .= $form->field($model, 'comment')->textArea(['rows' => 5]);
                $html .= $form->field($model, 'author_name')->textInput(['maxlength' => 255]);
                $html .= $form->field($model, 'author_email')->textInput(['maxlength' => 255]);
                $html .= $form->field($model, 'author_url')->textInput(['maxlength' => 255]);
                
                $html .= Html::submitButton('Submit', ['class' => 'btn btn-primary']); 
            ActiveForm::end();
        $html .= '</div>';
        
        return $html;
            
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
	    
        $postRender .= $this->renderThumbnail($post);
	    
	    $postRender .= '<h3 style="margin-top:0;">' . Html::a(Html::encode($post->title), ['blogposts/view', 'id' => $post->id, 'slug' => $post->slug, 'year' => date('Y',strtotime($post->date)), 'month' => date('m',strtotime($post->date)), 'day' => date('d',strtotime($post->date))]) . '</h3>';
	    $postRender .= '
	        <ul class="list-inline">
	            <li><i class="glyphicon glyphicon-calendar"></i> '.date('M d, Y',strtotime($post->date)).'</li>
	            <li><i class="glyphicon glyphicon-user"></i> '.$post->user_id.'</li>
	            <li><i class="glyphicon glyphicon-folder-close"></i> '.$post->id.'</li>
	            <li><i class="glyphicon glyphicon-comment"></i> Comments</li>
	        </ul>';
	    $postRender .= '<p>'.$this->renderExcerpt($post).'</p>';
        $postRender .= Html::a('Read Article',['blogposts/view', 'id' => $post->id, 'slug' => $post->slug, 'year' => date('Y',strtotime($post->date)), 'month' => date('m',strtotime($post->date)), 'day' => date('d',strtotime($post->date))],['class'=>'btn btn-success btn-xs pull-right']);
	    $postRender .= '</div></article></div>';
        $postRender .= '<hr />';
		return $postRender;
	}
	
	
	
	/**
	 * renderExcerpt function.
	 * 
	 * @access private
	 * @param mixed $post
	 * @return tring
	 */
	private function renderExcerpt($post){
    	
    	if($post->excerpt != '' && !empty($post->excerpt) ){
        	$text = $post->excerpt;
    	}else{
        	$text = $post->body;
    	}
    	
    	return $this->trimBetter($text,$this->maxLength);
    	
	}
	
	
	
	
	/**
	 * trimBetter function.
	 * 
	 * @access private
	 * @param mixed $input
	 * @param mixed $length
	 * @param bool $ellipses (default: true)
	 * @return string
	 */
	private function trimBetter($input, $length, $ellipses = true) {
        //strip tags, if desired
        if ($this->excerptStripTags) {
            $input = strip_tags($input);
        }
     
        //strip leading and trailing whitespace
        $input = trim($input);
     
        //no need to trim, already shorter than trim length
        if (strlen($input) <= $length) {
            return $input;
        }
     
        //leave space for the ellipses (...)
        if ($ellipses) {
            $length -= 3;
        }
     
        //this would be dumb, but I've seen dumber
        if ($length <= 0) {
            return '';
        }
     
        //find last space within length
        //(add 1 to length to allow space after last character - it may be your lucky day)
        $last_space = strrpos(substr($input, 0, $length + 1), ' ');
        if ($last_space === false) {
            //lame, no spaces - fallback to pure substring
            $trimmed_text = substr($input, 0, $length);
        }
        else {
            //found last space, trim to it
            $trimmed_text = substr($input, 0, $last_space);
        }
     
        //add ellipses (...)
        if ($ellipses) {
            $trimmed_text .= '...';
        }
        
        if($this->excerptStripTags){
           $trimmed_text = '<p>' . $trimmed_text . '</p>';
        }
        
        return $trimmed_text;
    }
    
    
    private function renderThumbnail($post){
        
        if($this->showThumbnail){
        
            $date = $post->date;
            
            $thumbnail = '<div class="col-md-4">';
            $thumbnail .= Html::a('',['blogposts/view', 'id' => $post->id, 'slug' => $post->slug, 'year' => date('Y',strtotime($date)), 'month' => date('m',strtotime($date)), 'day' => date('d',strtotime($date))],['class'=>'recentPostThumnail','style'=>'background-image:url('.$post->thumbnail.')']);
            $thumbnail .= '</div><div class="col-md-8">';
            
            return $thumbnail;
            
        }else{
            
            return '<div class="col-md-12">';
            
        }
        
        return false;
    }
}