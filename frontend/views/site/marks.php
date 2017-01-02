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


<div class="categories-view">

    <div class="content table-responsive table-full-width">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <?php
                foreach ($columns as $col)
                {
                        if ($col['title'] == 'student_id' || $col['title'] == 'الطالب') {
                            if (yii::$app->language == 'en')
                                echo '<th>' . ' FULL NAME' . '</th>';
                            else
                                echo '<th>' . 'اسم الطالب' . '</th>';
                        }
                        if ($col['title'] == 'subject_id' || $col['title'] == 'المادة') {
                            if (yii::$app->language == 'en')
                                echo '<th>' . 'Subject Name' . '</th>';
                            else
                                echo '<th>' . 'اسم المادة ' . '</th>';
                        }
                        if ($col['title'] == 'exam_mark' || $col['title'] == 'علامة الامتحان') {
                            if (yii::$app->language == 'en')
                                echo '<th>' . 'Mark' . '</th>';
                            else
                                echo '<th>' . 'العلامة' . '</th>';
                        }
                    }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($rows as $key =>$row)
            {
               echo '<tr>';
                $st_info = MyController::getItemInfo($row['student_id']['value'],$lang);
                echo '<td>'.$st_info['first_name']['value'].' '.$st_info['last_name']['value'].'</td>';
                $sub_info = MyController::getItemInfo($row['subject_id']['value'],$lang);
                echo '<td>'.$sub_info['title']['value'].'</td>';
               // echo '<td>'.$row['subject_id']['value'];
                echo '<td>'.$row['exam_mark']['value'];
                echo '</tr>';

            }
            ?>
            </tbody>
        </table>
    </div>

    </div>

<?php
/*
$lang = yii::$app->language;
$subjects = [];
$students = [];

foreach ( $rows as $key => $row ) {

//    $cat = \backend\models\Items::find()->where(['item_id'=> $row['student_id']['value'] ])->one();
//    $cat =$cat['category_id'];
//    $cat = Categories::findOne(['category_id' => $cat]);
      $item_info = MyController::getItemInfo($row['student_id']['value'], $lang);
        $students[$row['subject_id']['value']] = $item_info;
}

foreach ($students as $k => $s) {
    echo $k.'=>'.$s['first_name']['value'].' '.$s['last_name']['value'].'<br>';
}*/

?>




















