<?php

/* @var $this yii\web\View */
/* @var $item backend\models\ItemLanguage */

use yii\helpers\Html;

$this->title = $item['title']['value'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="row">
        <div class="col-sm-8">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

        <div class="row">
            Question: <?= $item['question_text']['value'] ?>
            <br>
            Choice 1: <?= $item['choice1']['value'] ?>
            <br>
            Choice 2: <?= $item['choice2']['value'] ?>
            <br>
            Choice 3: <?= $item['choice3']['value'] ?>
            <br>
            Choice 4: <?= $item['choice4']['value'] ?>
            <br>
            Answer: <?= $item['answer']['value'] ?>
        </div>


</div>

