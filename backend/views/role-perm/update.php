<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RolePerm */

$this->title = 'Update Role Perm: ' . $model->role_perm_id;
$this->params['breadcrumbs'][] = ['label' => 'Role Perms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->role_perm_id, 'url' => ['view', 'id' => $model->role_perm_id]];
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