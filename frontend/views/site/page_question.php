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
<br>

    <table class="ui blue table">
        <tbody>
        <tr>
            <td>Question</td>
            <td><?= $item['question_text']['value'] ?></td>
        </tr>
        <tr>
            <td>Choice 1</td>
            <td><?= $item['choice1']['value'] ?></td>
        </tr>
        <tr>
            <td>Choice 2</td>
            <td><?= $item['choice2']['value'] ?></td>
        </tr>
        <tr>
            <td>Choice 3</td>
            <td><?= $item['choice3']['value'] ?></td>
        </tr>
        <tr>
            <td>Choice 4</td>
            <td><?= $item['choice4']['value'] ?></td>
        </tr>
        <tr>
            <td>Answer</td>
            <td><?= $item['answer']['value'] ?></td>
        </tr>
        </tbody>
    </table>

</div>

