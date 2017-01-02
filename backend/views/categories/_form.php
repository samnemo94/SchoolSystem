<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Categories;
use wbraganca\dynamicform\DynamicFormWidget;
/* @var $this yii\web\View */
/* @var $model backend\models\categories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'category_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\models\Categories::find()->all(),'category_id','category_title'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a parent...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    <?= $form->field($model , 'showing_parent')->checkbox() ?>

    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Columns</h4></div>
            <div class="panel-body">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    //'limit' => 10, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $modelsFields[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'field_title',
                        'field_title_ar',
                        'field_type',
                        'fk_table',
                        'has_translate',
                        'is_null',
                        'is_show'
                    ],
                ]); ?>

                <div class="container-items"><!-- widgetContainer -->
                    <?php foreach ($modelsFields as $i => $modelFields): ?>
                        <div class="item panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left">Columns :</h3>
                                <div class="pull-right">
                                    <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                // necessary for update action.
                                if (! $modelFields->isNewRecord) {
                                    echo Html::activeHiddenInput($modelFields, "[{$i}]field_id");
                                }
                                ?>

                                <div class="row">
                                    <div class="col-sm-2">
                                        <?= $form->field($modelFields, "[{$i}]field_title")->textInput(['maxlength' => true])->label('Name') ?>
                                    </div>
                                    <div class="col-sm-2">
                                        <?= $form->field($modelFields, "[{$i}]field_title_ar")->textInput(['maxlength' => true])->label('Arabic Name') ?>
                                    </div>
                                    <div class="col-sm-2">
                                        <?= $form->field($modelFields, "[{$i}]field_type")->dropDownList([ 'varchar' => 'varchar', 'text' => 'text',
                                                                                                            'int' => 'int', 'double' => 'double',
                                                                                                            'date'=>'date','time'=>'time' ,
                                                                                                            'date_time' => 'date_time', 'image'=>'image' ,
                                                                                                            'file'=>'file' , 'foreign_key' => 'foreign_key'],
                                                                                                            ['prompt' => ''])->label('Type')  ?>
                                    </div>
                                    <div class="col-sm-2">
                                        <?= $form->field($modelFields, "[{$i}]fk_table")->dropDownList(ArrayHelper::map(Categories::find()->all(),'category_id','category_title'),
                                                                                            ['prompt'=>'select table'])->label('Related Table') ?>
                                    </div>

                                    <div class="col-sm-2">
                                        <?= $form->field($modelFields , "[{$i}]has_translate")->checkbox(['label'=>''])->label('Has translate') ?>
                                    </div>
                                    <div class="col-sm-1">
                                        <?= $form->field($modelFields , "[{$i}]is_null")->checkbox(['label'=>''])->label('Null') ?>
                                    </div>
                                    <div class="col-sm-1">
                                        <?= $form->field($modelFields , "[{$i}]is_show")->checkbox(['label'=>''])->label('Show') ?>
                                    </div>
                                </div>
                             </div>
                            </div>
                    <?php endforeach; ?>
                </div >
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div >
        </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
