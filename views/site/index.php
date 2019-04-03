<?php

use yii\bootstrap\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'IT.IS';
$link = Url::to(['api/index'], true);
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>API URL IS</h1>
        <p class="lead">
            <?= Html::a($link, $link); ?>
        </p>
    </div>
</div>
