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

    <p>
        <?= Html::a(Yii::t('app', 'Create Notes'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'selected_user',
                'label' => 'User',
                'value' => 'user.email',

            ],
            'title',
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
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Notes $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
