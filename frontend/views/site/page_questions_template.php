<?php

/* @var $this yii\web\View */
/* @var $item backend\models\ItemLanguage */

use yii\helpers\Html;

$this->title = 'Q'.$item['order']['value'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="row">
        <div class="col-sm-8">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

        <div class="row">
            Question: <a href="<?= \yii\helpers\Url::to(['/site/page/','id'=>$question['item_id']]) ?>"><?= $question['title']['value'] ?></a>
            <br>
            Mark: <?= $item['mark']['value'] ?>
            <br>
            Order: <?= $item['order']['value'] ?>
        </div>


</div>

