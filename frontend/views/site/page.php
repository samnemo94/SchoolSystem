<?php

/* @var $this yii\web\View */
/* @var $item backend\models\Items */

use yii\helpers\Html;
$lang = 9;

$this->title = $item->getItemLanguages()->where(['language_id' => $lang])->one()->item_title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div>
        <img align="right" style="padding-right: 40px" width="512px" src="../../backend/web/<?= $item->getItemLanguages()->where(['language_id' => $lang])->one()->item_image ?>">
        <?= $item->getItemLanguages()->where(['language_id' => $lang])->one()->item_description ?>
    </div>


</div>
