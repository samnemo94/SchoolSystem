<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ItemLanguage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-language-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'language_id')->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\models\Languages::find()->all(), 'language_id', 'language_name'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a language...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'item_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'item_short_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'item_description')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?php
    echo $form->field($model, 'item_image')->widget(\kartik\file\FileInput::classname(), [
        'options' => [
            'accept' => 'image/*'
        ],
        'pluginOptions' => [
            'initialPreview' => [
                $model->item_image,
            ],
            'initialPreviewAsData' => true,
            'overwriteInitial' => true,
            'showRemove' => true,
            'showUpload' => false,
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
