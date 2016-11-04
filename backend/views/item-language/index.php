<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ItemLanguageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Item Languages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-language-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Item Language', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'item_language_id',
            'item_id',
            'language_id',
            'item_title',
            'item_description:ntext',
            // 'item_short_description:ntext',
            // 'item_image',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
