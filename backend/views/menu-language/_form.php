<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MenuLanguage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-language-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'language_id')->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\models\Languages::find()->all(),'language_id','language_name'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a language...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
