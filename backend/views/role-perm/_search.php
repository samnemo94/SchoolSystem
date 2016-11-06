<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RolePermSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="role-perm-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'role_perm_id') ?>

    <?= $form->field($model, 'role_id') ?>

    <?= $form->field($model, 'permission_id') ?>

    <?= $form->field($model, 'created_by') ?>

    <?= $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
