<?php

/** @var \common\models\Notes[] $model */
?>


<?php foreach ($model as $item){
    echo \yii\helpers\Html::a($item->title, ['site/view-note', 'id' => $item->id] ) .'<br>';
}?>