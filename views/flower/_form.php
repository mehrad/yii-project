<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

?>

<div class="flower-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'keywords')->widget(Select2::classname(), [
    'name' => 'keywords',
    'value' => $oldKeywordsTitles, // initial value
    'data' => $allKeywordsTitles,
    'maintainOrder' => true,
    'toggleAllSettings' => [
        'selectLabel' => '<i class="glyphicon glyphicon-ok-circle"></i> Tag All',
        'unselectLabel' => '<i class="glyphicon glyphicon-remove-circle"></i> Untag All',
        'selectOptions' => ['class' => 'text-success'],
        'unselectOptions' => ['class' => 'text-danger'],
    ],
    'options' => ['placeholder' => 'تگ مرتبط را انتخاب کنید', 'multiple' => true],
    'pluginOptions' => [
        'tags' => true,
        'maximumInputLength' => 10
    ],
]); ?>
   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
