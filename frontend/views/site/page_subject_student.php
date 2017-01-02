<?php

/* @var $this yii\web\View */
/* @var $item backend\models\ItemLanguage */

use yii\helpers\Html;

$this->title = $item['title']['value'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1 align="center"><?= Html::encode($this->title) ?></h1>
    <div>
        <?php if (array_key_exists('image',$item)){ ?>
        <img width="100%" src="<?= $item['image']['value'] ?>">
        <?php
        }
        ?>

        <?php
        if ($is_registered)
        {
            ?>

            <div style="padding-top: 150px">
                <?= $item['description']['value'] ?>
            </div>
            <?php
        }
        else
        {
            ?>
                <a href="<?= \yii\helpers\Url::to(['/site/insert','id'=>$student_subject_category,'fk_id'=>Yii::$app->user->isStudent]) ?>">Register On This Subject</a>
            <?php
        }
        ?>
    </div>

    <?php
    if ($is_registered && $is_exam){
        echo '<div>';
    echo html::a('Do Exam',['/site/exam','id'=>$item['item_id']]);

    echo '</div>';
    }

    ?>

</div>
