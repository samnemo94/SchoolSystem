<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Permissions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permissions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'permission_page')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'permission_action')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'permission_description')->textarea(['rows' => 2]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
