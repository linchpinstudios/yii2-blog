<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>

<div class="well">
    
    <div id="commentForm">
    
        <?php 
            $form = ActiveForm::begin([
                'action' => ['blogcomments/ajaxsubmit'],
                'enableAjaxValidation'      => false,
                'enableClientValidation'    => true,
                'beforeSubmit'              => "
                    function(form) {
                        if($(form).find('.has-error').length) {
                            return false;
                        }
                        
                        $.ajax({
                            url: form.attr('action'),
                            type: 'post',
                            data: form.serialize(),
                            success: function(data) {
                                if(data.success){
                                    $('#commentForm').hide(function(){
                                        $('#commentThanks').show();
                                    });
                                }
                            }
                        });
                        
                        return false;
                    }",
            ]);
            
            echo Html::activeHiddenInput($model, 'post_id', ['value' => $id]);
        ?>
        
            <h4>Leave a Comments</h4>
            
            <?= $form->field($model, 'comment')->textArea(['rows' => 5]); ?>
            
            <div class="details">
                <?= $form->field($model, 'author_name')->textInput(['maxlength' => 255]); ?>
                <?= $form->field($model, 'author_email')->textInput(['maxlength' => 255]); ?>
                <?= $form->field($model, 'author_url')->textInput(['maxlength' => 255]); ?>
            </div>
                    
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']);  ?>
            
        <?php ActiveForm::end(); ?>
    
    </div>
    
    <div id="commentThanks" style="display:none">
        
        <h4>Thanks for commenting!</h4>
        
    </div>

</div>


<div>
<?
    
    foreach($comments as $c){
        
        echo '<div class="row">';
            echo '<div class="col-md-12">';
                echo '<strong>'.$c->author_name.'</strong> - '.date('F d, Y H:m a',strtotime($c->date)).'<br />';
                echo $c->comment;
            echo '</div>';
        echo '</div>';
        echo '<hr />';
    }
    
?>
</div>




