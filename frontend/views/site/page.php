<?php

/* @var $this yii\web\View */
/* @var $item backend\models\Items */

use yii\helpers\Html;
$lang = \backend\models\Languages::findOne(['language_code'=>Yii::$app->language])->language_id;

$this->title = $item->getItemLanguages()->where(['language_id' => $lang])->one()->item_title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div>
        <img class="page-image" width="512px" src="../../backend/web/<?= $item->getItemLanguages()->where(['language_id' => $lang])->one()->item_image ?>">

        <?= $item->getItemLanguages()->where(['language_id' => $lang])->one()->item_description ?>

    </div>


</div>
