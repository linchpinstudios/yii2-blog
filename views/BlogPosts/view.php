<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;
use linchpinstudios\blog\widgets\Categories;
use linchpinstudios\blog\widgets\Comments;

/**
 * @var yii\web\View $this
 * @var common\models\BlogPosts $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'] = [['label' => 'Blog', 'url' => ['/blog']],$this->title];

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
                
                <h2><?= Html::encode($this->title) ?></h2>
    			    
                <?= $model->body; ?>
                
                <?= ($module->publicComments ? Comments::widget(['id' => $model->id] : '') ?>

			</div>
			<div class="col-md-4">
				<?= Categories::widget() ?>
			</div>
		</div>
	</div>
	