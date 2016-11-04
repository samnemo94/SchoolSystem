<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\itemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Items', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model)
        {
            if ($model->deleted_by)
            {
                return ['class' => 'danger'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['style' => 'width:30px;'],],

            'item_title',
            [
                'attribute' => 'category_id',
                'label' => 'Category',
                'value' => function ($model)
                {
                    if ($model->category)
                    {
                        return $model->category->category_title;
                    }
                    return '-';
                }
            ],
            [
                'attribute' => 'created_by',
                'value' => function ($model)
                {
                    if ($model->createdBy)
                    {
                        return $model->createdBy->username;
                    }
                    return '-';
                }
            ],
            'created_at',
            // 'updated_by',
            // 'updated_at',
            // 'deleted_by',
            // 'deleted_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width:60px;'],
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key)
                    {
                        return Html::a('<span class="pe-7s-look"></span>',
                            ['items/view', 'id' => $model->item_id], [
                                'title' => Yii::t('yii', 'View'),
                            ]);
                    },
                    'update' => function ($url, $model, $key)
                    {
                        if ($model->deleted_by)
                            return null;
                        return Html::a('<span class="pe-7s-pen"></span>',
                            ['items/update', 'id' => $model->item_id], [
                                'title' => Yii::t('yii', 'Update'),
                            ]);
                    },
                    'delete' => function ($url, $model, $key)
                    {
                        if ($model->deleted_by)
                            return null;
                        return Html::a('<span class="pe-7s-trash"></span>',
                            ['items/delete', 'id' => $model->item_id], [
                                'title' => Yii::t('yii', 'Delete'),
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]);
                    },
                ]
            ],
        ],
    ]); ?>
</div>