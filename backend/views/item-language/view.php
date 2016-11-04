<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ItemLanguage */

$this->title = $model->item_language_id;
$this->params['breadcrumbs'][] = ['label' => 'Item Languages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-language-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->item_language_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->item_language_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'item_language_id',
            'item_id',
            'language_id',
            'item_title',
            'item_description:ntext',
            'item_short_description:ntext',
            'item_image',
        ],
    ]) ?>

</div>
