<?php

use common\models\Notes;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
/** @var yii\web\View $this */
/** @var frontend\models\search\NotesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Notes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a($model->id, ['site/view-note', 'id' => $model->id] );
                }

            ],
            [
                'attribute' => 'selected_user',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a($model->user->email, ['site/view-user-note', 'id' => $model->user->id] );
                }

            ],

            [
                'attribute' => 'title',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a($model->title, ['site/view-note', 'id' => $model->id] );
                }

            ],
            [
                'attribute' => 'checked_tags',
                'label' => 'Tags',
                'value' => function ($model) {
                    /** @var \common\models\Tags $model */
                    $clubs = \yii\helpers\ArrayHelper::map($model->notesHasTags, 'id', 'tag.title');
                    return implode(',', $clubs);
                },
                'filter' => \common\models\Tags::getList()
            ],
            'order',
            [
                'value' => function ($data) {
                    $s = Notes::STATUS_LIST;
                    return $s[$data->status];
                },
                'attribute' => 'status',
                'filter' => Notes::STATUS_LIST
            ],

        ],
    ]); ?>


</div>
