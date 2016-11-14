<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Role */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="role-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'role_name')->textInput(['maxlength' => true]) ?>

    <?php
        $num_of_groups = (int)(sizeof($dataProvider)/2);
        if (sizeof($dataProvider)%2)
            $num_of_groups++;
        $num_of_buttons = 0;
        $i = 0;
        $max = 0;
        foreach ($dataProvider as $value)
        {
            $i++;
            if ($i > 2)
            {
                $num_of_buttons += (int)($max/2);
                if ($max%2)
                    $num_of_buttons++;
                $i = 1;
                $max = 0;
            }
            if (sizeof($value) > $max)
            {
                $max = sizeof($value);
            }
        }
        $num_of_buttons += (int)($max/2);
        if ($max%2)
            $num_of_buttons++;
    ?>

    <div style="min-height: <?= (30+10)+$num_of_groups*(13+1+13+13+1+13)+$num_of_buttons*(45) ?>px" >
    <h3>Permissions</h3>

    <?php
    foreach ($dataProvider as $key => $value)
    {
        ?>
        <div class="permissions-group">
            <h3><?= ucfirst($key) ?></h3>

            <?php
            foreach ($value as $val)
            {
                ?>
                <div class="permission-btn-group">
                        <span id="ico<?= $val['permission_id'] ?>"
                            class="before-permission-btn <?= array_key_exists($val['permission_id'], $checked) ? 'plus' : 'minus' ?>"
                            onclick="
                                event.preventDefault();
                                var chk = document.getElementById('chk<?= $val['permission_id'] ?>');
                                chk.checked = !chk.checked;
                                this.className = '';
                                if (chk.checked)
                                {
                                this.className = 'before-permission-btn plus';
                                }
                                else
                                {
                                this.className = 'before-permission-btn minas';
                                }
                                ">
                            <span class="bar1"></span>
                            <span class="bar2"></span>
                        </span>
                    <input hidden type='checkbox' name='check_list[]' value='<?= $val['permission_id'] ?>'
                        id="chk<?= $val['permission_id'] ?>" <?= array_key_exists($val['permission_id'], $checked) ? 'checked' : '' ?> />
                    <button class="btn btn-default permission-btn" onclick="
                        event.preventDefault();
                        var chk = document.getElementById('chk<?= $val['permission_id'] ?>');
                        chk.checked = !chk.checked;
                        var ico = document.getElementById('ico<?= $val['permission_id'] ?>');
                        ico.className = '';
                        if (chk.checked)
                        {
                        ico.className = 'before-permission-btn plus';
                        }
                        else
                        {
                        ico.className = 'before-permission-btn minas';
                        }
                        "
                    ><?= $val['permission_action'] ?></button>
                    <div class="clear"></div>
                </div>
                <?php
            }
            ?>

            <div class="clear"></div>
        </div>
        <?php
    }
    ?>
    </div>

    <div class="form-group" align="right">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

