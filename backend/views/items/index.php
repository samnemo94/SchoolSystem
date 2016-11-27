<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [

            ['class' => 'yii\grid\SerialColumn'],
            'item_id',
            ['label'=> 'category' ,
                'value'=>function ($data) {
                    $name = \backend\models\Categories::find()->where(['category_id'=>$data['category_id']])->one();
                    return $name['category_title'];}
            ],

            //'created_at',
            //'created_by',
            //'updated_at',
            // 'updated_by',
            // 'deleted',
            // 'deleted_at',
            // 'deleted_by',
            // 'modified_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
