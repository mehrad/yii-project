<?php

use yii\helpers\Html;
use yii\web\View;
use app\models\Keyword;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

?>

<?php
    $modelId = $model->id;
    $modelAdress = $model->imageAdress;
    $adress = \Yii::$app->getUrlManager()->createUrl(['flower/deleteimage', 'id' => $modelId]);
    $script = "";
    if (!empty($modelId))
    {
      $script = $script . "
        $(\"#ajaxButton\").click(function (){ 
                    $.ajax({
                        url: '$adress' ,
                        type: 'POST',
                        data: { id: $modelId },
                        success: function(data) {
                            $(\"#ajaxButton\").fadeOut();
                            $(\"#myImage\").fadeOut();
                            $(\"#insertImage\").fadeIn();
                         }
                        , error: function (request, status, error) {
                          alert(\"failed\");
                        }
                    }); 
                });" ;
    }

    if (!empty($modelAdress))
        $script = $script . "$(document).ready(function(){
                    $(\"#insertImage\").hide();
                    });";
    else 
        $script = $script . "$(document).ready(function(){
                    $(\"#ajaxButton\").hide();
                    });";
    $this->registerJs(
        $script,
        View::POS_READY,
        'my-button-handler'
);
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


    <?php
        if (!is_null($model->imageAdress))
        {
            echo Html::img($model->getFileUrl(), ['id' => "myImage", 'alt'=>'some', 'class'=>'thing']);
            // echo Html::a('Delete Image', ['deleteimage', 'id' => $model->id], [
            //         'id'    => 'ajaxButton',
            //         'class' => 'btn btn-danger',
            //         'data' => [
            //             'confirm' => 'Are you sure you want to delete this item?',
            //             'method' => 'post',
            //         ],
            // ]); 

        }
        echo $form->field($model, 'imageFile')->fileInput(['id' => "insertImage"]);
    ?>

    <a id='ajaxButton' class='btn btn-danger'>Delete image</a>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
