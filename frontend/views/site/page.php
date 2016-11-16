<?php

/* @var $this yii\web\View */
/* @var $item backend\models\ItemLanguage */

use yii\helpers\Html;

$this->title = $item->item_title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div>
        <img class="page-image" width="512px" src="../../backend/web/<?= $item->item_image ?>">

        <?= $item->item_description ?>

    </div>


</div>
