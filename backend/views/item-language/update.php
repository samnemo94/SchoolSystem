<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ItemLanguage */

$this->title = 'Update Item Language: ' . $model->item_language_id;
$this->params['breadcrumbs'][] = ['label' => 'Item Languages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->item_language_id, 'url' => ['view', 'id' => $model->item_language_id]];
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