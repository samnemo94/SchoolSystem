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
            <td>Date</td>
            <td><?= $item['exam_date']['value'] ?></td>
        </tr>
        <tr>
            <td>Template</td>
            <td><a href="<?= \yii\helpers\Url::to(['/site/page','id'=>$template['item_id']]) ?>"><?= $template['title']['value'] ?></a></td>
        </tr>
        </tbody>
    </table>

</div>