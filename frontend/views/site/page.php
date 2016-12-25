<?php

/* @var $this yii\web\View */
/* @var $item backend\models\ItemLanguage */

use yii\helpers\Html;

$this->title = $item['title']['value'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div>
        <?php if (array_key_exists('image',$item)){ ?>
        <img class="page-image" width="512px" src="../../backend/web/<?= $item['image']['value'] ?>">
        <?php
        }
        ?>

        <?= $item['description']['value'] ?>

    </div>


</div>
