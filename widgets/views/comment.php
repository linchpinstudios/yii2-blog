<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;



?>

<div class="well">
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
                            $('#joinForm').hide(function(){
                                $('#joinThanks').show();
                            });
                        }
                    }
                });
                
                return false;
            }",
    ]);
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


<?
    
    print_r($comments);
    
?>




