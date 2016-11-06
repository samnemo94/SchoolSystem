<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Permissions */

$this->title = 'Update Permissions: ' . $model->permission_id;
$this->params['breadcrumbs'][] = ['label' => 'Permissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->permission_id, 'url' => ['view', 'id' => $model->permission_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permissions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
