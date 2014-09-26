<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use linchpinstudios\datetimepicker\DateTime;
use dosamigos\tinymce\TinyMce;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var linchpinstudios\blog\models\BlogPosts $model
 * @var yii\widgets\ActiveForm $form
 */

$tfArray = [
    '1' => 'Enabled',
    '0' => 'Disabled',
]

?>

<div class="blog-posts-form">

    <?php $form = ActiveForm::begin(); ?>
    
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Blog Post</strong></div>
                    <div class="panel-body">
                
                        <?= $form->field($model, 'title')->textInput(['maxlength' => 555]) ?>
                        
                        
                        <?= $form->field($model, 'body')->widget(TinyMce::className(), [
                            'options' => ['rows' => 25],
                            'language' => 'en',
                            'clientOptions' => [
                                'plugins' => [
                                    "advlist autolink lists link charmap print preview anchor",
                                    "searchreplace visualblocks code fullscreen image",
                                    "insertdatetime media table contextmenu paste filemanager"
                                ],
                                'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image filemanager"
                            ]
                        ]); ?>
                        
        
                        <?= $form->field($model, 'excerpt')->textarea(['rows' => 6]) ?>
            
            
                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>
                
                    </div>
                </div>
        
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Settings</strong></div>
                    <div class="panel-body">
                        <?= $form->field($model, 'user_id')->dropDownList($model->authorList) ?>
            
                        <?= $form->field($model, 'status')->dropDownList($tfArray) ?>
                        
                        <?= $form->field($model, 'comments')->dropDownList($tfArray) ?>
                    
                        <?= $form->field($model, 'date')->widget(DateTime::className(), ['options' => ['class' => 'form-control']]) ?>
                
                        <?= $form->field($model, 'slug')->textInput(['maxlength' => 45]) ?>
                    </div>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Categories</strong>
                        <?= Html::a('<i class="glyphicon glyphicon-plus-sign"></i> Add', ['#'], ['class' => 'pull-right', 'id' => 'add-category']) ?>
                    </div>
                    <div class="panel-body">
                        
                        <?php //print_r($model->terms); ?>
                        <div class="categories-wrapper">
                            <?php
                                $availableCategories = ArrayHelper::map($categories, 'id', 'name');
                                $preselectedOptions = ArrayHelper::map(ArrayHelper::toArray($model->terms), 'id', 'term_id');
                            ?>
                            <?= Html::checkboxList('categories',$preselectedOptions,$availableCategories,['id' => 'categories-con']) ?>
                        </div>
                    </div>
    
    <?php ActiveForm::end(); ?>
                    
                    <div class="panel-footer" id="create-category-form" style="display:none">
                        
                        <?php
                            $form = ActiveForm::begin([
                                'action' => ['blogterms/createcategory'],
                                'enableAjaxValidation'      => false,
                                'enableClientValidation'    => true,
                                'afterValidate'             => "
                                    function(form) {
                                        if($(form).find('.has-error').length) {
                                            return false;
                                        }
                                        
                                        $.ajax({
                                            url: form.attr('action'),
                                            type: 'post',
                                            data: form.serialize(),
                                            success: function(data) {
                                                if(data.error){
                                                    $('.field-blogterms-name').addClass('has-error');
                                                    $('.field-blogterms-name .help-block').text(data.error.name);
                                                }
                                                if(data.success){
                                                    $('#create-category-form').toggle();
                                                    
                                                    $('#categories-con').append('<div class=\"checkbox\"><label><input type=\"checkbox\" name=\"categories[]\" checked=\"checked\" value=\"'+data.model.id+'\"> '+data.model.name+'</label></div>');
                                                }
                                            }
                                        });
                                        
                                        return false;
                                    }",
                            ]);
                        ?>
                            <?= $form->field($terms, 'name')->textInput(['maxlength' => 255]) ?>
                            <?= Html::submitButton('<i class="glyphicon glyphicon-plus-sign"></i> Create', ['class' => 'btn btn-success', 'id' => 'create-category']) ?>
                        
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>

</div>

