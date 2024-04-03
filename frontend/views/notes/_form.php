<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Notes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="notes-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'order')->textInput() ?>

            <?= $form->field($model, 'status')->dropDownList(\common\models\Notes::STATUS_LIST) ?>

            <?php echo $form->field($model, 'tags')->widget(\kartik\select2\Select2::classname(), [
                'data' => \common\models\Tags::getList(),
                'options' => ['placeholder' => 'Select a News Feed ...', 'multiple' => true],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
