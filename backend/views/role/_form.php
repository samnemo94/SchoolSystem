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

    echo "the permissions :";
    echo "<br>";
    echo "<br>";

        if ( $checked  ){
                for($i=0;$i<sizeof($dataProvider);$i++)
                {
                if ( in_array($dataProvider[$i]['permission_id'], $checked)){
                    echo "<input type='checkbox' name='check_list[]' checked value='{$dataProvider[$i]['permission_id']}'>" .$dataProvider[$i]['permission_page']."-".$dataProvider[$i]['permission_action'];
                    echo "<br>";
                }
                else {
                    echo "<input type='checkbox' name='check_list[]' value='{$dataProvider[$i]['permission_id']}'>" . $dataProvider[$i]['permission_page'] . "-" . $dataProvider[$i]['permission_action'];
                    echo "<br>";
                }

            }
    }
        else {
            for ($i = 0; $i < sizeof($dataProvider); $i++) {
                echo "<input type='checkbox' name='check_list[]' value='{$dataProvider[$i]['permission_id']}'>" . $dataProvider[$i]['permission_page'] . "-" . $dataProvider[$i]['permission_action'];
                echo "<br>";
            }
        }

    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
