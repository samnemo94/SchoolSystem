<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\menus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menus-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'menu_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\models\Menus::find()->all(),'menu_id','menu_title'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a parent...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'category_id')->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\models\Categories::find()->all(),'category_id','category_title'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a category...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'menu_position')->widget(\kartik\select2\Select2::classname(), [
        'data' => ['top' => 'Top', 'right' => 'Right', 'left' => 'Left', 'bottom' => 'Bottom'],
        'language' => 'en',
        'options' => ['placeholder' => 'Select menu position...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'item_id')->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\models\Items::find()->all(),'item_id','item_title'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select an item...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-fill pull-right"' : 'btn btn-primary btn-fill pull-right"']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
