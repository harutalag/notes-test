<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Notes $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Notes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="notes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user.email',
            'title',
            'text:ntext',
            'order',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    $statuses = \common\models\Notes::STATUS_LIST;
                    return $statuses[$model->status];
                },
            ],
            'created_at:datetime',
            'updated_at:datetime',
            'deleted_at:datetime',
        ],
    ]) ?>

    <br>

    <h3>Tags</h3>
    <hr>
    <?php foreach ($model->notesHasTags as $hasTag){?>
        <span class="label label-warring"><?=$hasTag->tag->title?></span>
    <?php } ?>
</div>
