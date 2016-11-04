<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MenuLanguage */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Menu Languages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-language-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->menu_language_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->menu_language_id], [
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
            'menu_language_id',
            'menu_id',
            'language_id',
            'title',
        ],
    ]) ?>

</div>
