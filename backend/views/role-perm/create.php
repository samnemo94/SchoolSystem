<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RolePerm */

$this->title = 'Create Role Perm';
$this->params['breadcrumbs'][] = ['label' => 'Role Perms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-perm-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
