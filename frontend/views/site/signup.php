<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$lang = yii::$app->language;
if ( $lang == 'en')
$this->title = 'Signup';
else $this->title = 'انشاء حساب';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    if ( yii::$app->language == 'en')
    echo ' <p>Please fill out the following fields to signup:</p>';
    else
    echo '<p>' . 'يرجى تعبئة الحقول التالية لانشاء حساب جديد:'.'</p>';
    ?>

    <div class="row">
        <div class="col-lg-5" style="float: <?= Yii::$app->language=='ar'?'right':'left' ?>;">
            <?php $form = ActiveForm::begin(['id' => 'form-signup','options' => ['enctype' => 'multipart/form-data','class'=>'ui form']]); ?>
            <?php   if ( $lang == 'en') { ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'firstName') ?>
            <?= $form->field($model, 'lastName') ?>
            <?= $form->field($model, 'age') ?>
            <?= $form->field($model, 'address') ?>

            <?= $form->field($model, 'year') ?>

            <?= $form->field($model, 'phone') ?>

            <?= $form->field($model, 'photo')->fileInput() ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput();}
            else { ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('اسم المستخدم') ?>

                <?= $form->field($model, 'firstName')->label('الاسم الأول') ?>
                <?= $form->field($model, 'lastName')->label('الكنية') ?>
                <?= $form->field($model, 'age')->label('العمر') ?>
                <?= $form->field($model, 'address')->label('العنوان') ?>

                <?= $form->field($model, 'year')->label('السنة الدراسية') ?>

                <?= $form->field($model, 'phone')->label('الهاتف') ?>

                <?= $form->field($model, 'photo')->label('الصورة الشخصية') ?>

                <?= $form->field($model, 'email')->label('البريد الالكتروني')?>

                <?= $form->field($model, 'password')->passwordInput()->label('كلمة المرور');
            }
            ?>

            <div class="form-group">
                <?php if( $lang == 'en')
                    echo  Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']);
                else
                    echo Html::submitButton('انشاء حساب', ['class' => 'btn btn-primary', 'name' => 'signup-button']);
                ?>

            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
