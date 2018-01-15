<?php

use yii\helpers\Html;



$this->title = 'Update Flower: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Flowers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="flower-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'keywords' => $keywords,
    ]) ?>

</div>
