<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

    
<h3>Categories</h3>

<ul class="list-unstyled">
    <?php
        foreach($model as $m){
            echo '<li>'.Html::a($m->name.' ('.count($m->blogTermRelationships).')',['blogposts/category', 'id' => $m->id, 'category' => $m->slug]).'</li>';
        }
    ?>
</ul>