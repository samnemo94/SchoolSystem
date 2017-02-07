<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 1/1/2017
 * Time: 11:26 PM
 */

?>


    <h1 align="center"><?= $subject_info['title']['value'].' '.'Exam' ?></h1>
    <div >
        <?php $form = ActiveForm::begin(['action' =>'index.php?r=site/exam&id='.$subject_info['item_id'], 'method' => 'post']); ?>

        <?php
            foreach ($questions as $key => $question)
            {
                echo '<div>';
                echo $question['question_text']['value'];
                echo '<input type="radio" value="'.$question['choice1']['value'].'"  name="'.$key.'"><label> '.$question['choice1']['value'].'</label></br>';
                echo '<input type="radio" value="'.$question['choice2']['value'].'"  name="'.$key.'"><label>'.$question['choice2']['value'].' </label> </br>';
                echo '<input type="radio" value="'.$question['choice3']['value'].'"  name="'.$key.'"> <label>'.$question['choice3']['value'].' </label></br>';
                echo '<input type="radio" value="'.$question['choice4']['value'].'"  name="'.$key.'"> <label>'.$question['choice4']['value'].'</label></br>'.'<br>';
                echo '</div>';
            }
        ?>
        <?= Html::submitButton('submit', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end(); ?>

    </div>

</div>