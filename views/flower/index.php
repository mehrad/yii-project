<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\FlowerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Flowers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flower-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Flower', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'likeCount',
            'title',
            'createdAt:datetime',
            [
                'label' => 'تگ ها',
                'value' => function($model) { 
                    // if (!empty($model->keywords))
                    //     dd($model->keywords);
                    return  implode(',', ArrayHelper::getColumn($model->keywords,'title'));
                },
                
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
