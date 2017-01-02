<?php

use backend\controllers\MyController;
use backend\models\Categories;
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 1/1/2017
 * Time: 12:33 AM
 */
$lang = \backend\models\Languages::findOne(['language_code' => Yii::$app->language])->language_id;
echo '<br>';

?>
<div class="col-lg-12" style="float: <?= Yii::$app->language=='ar'?'right':'left' ?>;">
    <div class="content table-responsive table-full-width">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
             <?php
             if(Yii::$app->language == 'en'){
                 echo '<th>'.'subject'.'</th>';
                 echo '<th>'.'Mark'.'</th>';
             }
             else {
                 echo '<th>'.'المادة'.'</th>';
                 echo '<th>'.'العلامة'.'</th>';
             }
             ?>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($myMarks as $key =>$mark)
            {
                echo '<tr>';
                echo '<td>'.$key.'</td>';
                echo '<td>'.$mark;
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
    </div>




















