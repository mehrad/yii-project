<?php

use yii\helpers\Html;




$this->title = 'ایجاد گل ها ';
$this->params['breadcrumbs'][] = ['label' => 'Flowers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flower-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
