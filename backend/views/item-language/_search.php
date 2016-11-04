<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ItemLanguageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-language-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'item_language_id') ?>

    <?= $form->field($model, 'item_id') ?>

    <?= $form->field($model, 'language_id') ?>

    <?= $form->field($model, 'item_title') ?>

    <?= $form->field($model, 'item_description') ?>

    <?php // echo $form->field($model, 'item_short_description') ?>

    <?php // echo $form->field($model, 'item_image') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
