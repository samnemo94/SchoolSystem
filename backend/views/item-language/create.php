<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ItemLanguage */

$this->title = 'Create Item Language';
$this->params['breadcrumbs'][] = ['label' => 'Item Languages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="header">
        <h3 class="title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="content">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>