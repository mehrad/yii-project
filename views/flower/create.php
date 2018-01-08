<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Flower */

$this->title = 'Create Flower';
$this->params['breadcrumbs'][] = ['label' => 'Flowers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flower-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
