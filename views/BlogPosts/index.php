<?php

use linchpinstudios\blog\widgets;

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;
use linchpinstudios\blog\widgets\BlogPostsWidget;
use linchpinstudios\blog\widgets\BlogCategoriesWidget;


/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\BlogPostsSearch $searchModel
 */

$this->title = 'Blog Posts';
$this->params['breadcrumbs'][] = $this->title;
?>


	<div class="container large-padding">
	    <div class="row">
	        <div class="col-md-8">
                
                <?php
                    // $this is the view object currently being used
                        echo Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]);
                ?>
                
	        </div>
	    </div>
		<div class="row">
			<div class="col-md-8">
                <?= BlogPostsWidget::widget(['limit'=>2]); ?>
			</div>
			<div class="col-md-4">
			    <?= BlogCategoriesWidget::widget(); ?>
			</div>
		</div>
	</div>