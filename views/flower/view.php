<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Flower */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Flowers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flower-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= 
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'likeCount',
            'title',
            'createdAt:datetime',
            [
                'label' => 'تگ ها',
                'attribute' => 'keywords',
                'value' => implode(', ', $model->getKeywords()),
            ]
        ],
    ]) ?>

    <?php 
     if (!is_null($model->imageAdress))
        {
            echo Html::img($model->getFileUrl(), ['alt'=>'some', 'class'=>'thing']);
        }
    ?>
    
</div>
