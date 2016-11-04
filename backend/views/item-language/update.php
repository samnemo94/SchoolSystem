<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ItemLanguage */

$this->title = 'Update Item Language: ' . $model->item_language_id;
$this->params['breadcrumbs'][] = ['label' => 'Item Languages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->item_language_id, 'url' => ['view', 'id' => $model->item_language_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-language-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
