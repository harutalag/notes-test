<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Notes $model */

$this->title = Yii::t('app', 'Create Notes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Notes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
