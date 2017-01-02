<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

if ( yii::$app->language == 'en')
$title = 'Login';
else
    $title = 'تسجيل الدخول';

$this->params['breadcrumbs'][] = $title;
?>
<div class="site-login">
    <h1><?= $title ?></h1>
    <?php
    if ( yii::$app->language == 'en')
    echo ' <p>Please fill out the following fields to login:</p>';
    else
       echo '<p>' . 'يرجى تعبئة الحقول التالية لتسجيل الدخول:'.'</p>';
    ?>

    <div class="row">
        <div class="col-lg-5" style="float: <?= Yii::$app->language=='ar'?'right':'left' ?>;">
            <?php $form = ActiveForm::begin(['id' => 'login-form']);
            if ( yii::$app->language == 'en'){ ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <?php  }
            else
            { ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('اسم المستخدم') ?>

            <?= $form->field($model, 'password')->passwordInput()->label('كلمة المرور') ?>

            <?= $form->field($model, 'rememberMe')->checkbox()->label('تذكرني') ?>

           <?php  } ?>

<!--                <div style="color:#999;margin:1em 0">-->
<!--                    --><?php //if ( yii::$app->language == 'en'){  ?>
<!--                    If you forgot your password you can --><?//= Html::a('reset it', ['site/request-password-reset']); }
//                    else { ?>
<!-- اذانسيت كلمة المرور تستطيع                 --><?//= Html::a('تغيير كلمة المرور', ['site/request-password-reset']); }
//                    ?><!--.-->
<!--                </div>-->
            <?php  if (yii::$app->language == 'en')
            {
                echo '<div class="form-group">';
                echo Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']);
                echo '</div>';

            }
                else {
                    echo '<div class="form-group">';
                    echo Html::submitButton('تسجيل الدخول', ['class' => 'btn btn-primary', 'name' => 'login-button']);
                    echo '</div>';
                }
            ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
