<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\menus */

$this->title = 'Update Menus: ' . $model->menu_id;
$this->params['breadcrumbs'][] = ['label' => 'Menuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->menu_id, 'url' => ['view', 'id' => $model->menu_id]];
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