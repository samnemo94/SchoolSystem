<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Role */

$this->title = 'Update Role: ' . $model->role_id;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->role_id, 'url' => ['view', 'id' => $model->role_id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="card">
    <div class="header">
        <h3 class="title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="content">
        <?= $this->render('_form', [
            'model' => $model,
            'checked' => $checked,
            'dataProvider' => $dataProvider,
        ]) ?>
    </div>
</div>