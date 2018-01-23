<?php

use yii\helpers\Html;
use app\models\Keyword;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

?>

<div class="flower-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'keywords')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Keyword::find()->all(), 'title', 'title'),
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

   <?= $form->field($model, 'imageFile')->fileInput() ?>
   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
