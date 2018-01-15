<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>گلست!</h1>

        <p class="lead">سایت جامع گل فروشی</p>
        <?= HTML::a('ورود', ['flower/index'], ['class' => "btn btn-lg btn-success"]) ?>
    </div>
</div>
