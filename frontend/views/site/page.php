<?php

/* @var $this yii\web\View */
/* @var $item backend\models\ItemLanguage */

use yii\helpers\Html;

$this->title = $item['title'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about" xmlns="http://www.w3.org/1999/html">
    <h1><?= Html::encode($this->title) ?></h1>
    <div>
        <?php if (array_key_exists('image',$item)){ ?>
        <img class="page-image" width="512px" src="../../backend/web/<?= $item['image'] ?>">
        <?php
        }
        ?>

        <?= $item['description'] ?>
        </br>
        <div>
            <?php
            foreach ($childs as $child) {
                echo $child['category_title'].' :';
               $items=  \backend\models\Items::find()->where(['category_id'=>$child['category_id']])->all();
                foreach ($items as $item){
                    echo $item['item_id'].'</br>';
                }
            }
            ?>
        </div>


    </div>


</div>
