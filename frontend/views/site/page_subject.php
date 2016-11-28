<?php

/* @var $this yii\web\View */
/* @var $item backend\models\ItemLanguage */

use yii\helpers\Html;

$this->title = $item['title'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1 align="center"><?= Html::encode($this->title) ?></h1>
    <div>
        <?php if (array_key_exists('image',$item)){ ?>
        <img width="100%" src="<?= $item['image'] ?>">
        <?php
        }
        ?>

        <div style="padding-top: 150px">
        <?= $item['description'] ?>
        </div>
    </div>


</div>
