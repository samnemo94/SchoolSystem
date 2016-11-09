<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MenuLanguage */

$this->title = 'Update Menu Language: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Menu Languages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->menu_language_id]];
$this->params['breadcrumbs'][] = 'Update';
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