<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\menusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menus-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Menus', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['style' => 'width:30px;'],
            ],

            'menu_title',
            [
                'attribute' => 'parent_id',
                'label' => 'Parent Menu',
                'value' => function ($model)
                {
                    if ($model->parent)
                    {
                        return $model->parent->menu_title;
                    }
                    return '-';
                }
            ],
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
            'menu_position',
            [
                'attribute' => 'item_id',
                'label' => 'Item',
                'value' => function ($model)
                {
                    if ($model->item)
                    {
                        return $model->item->item_title;
                    }
                    return '-';
                }
            ],


            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width:60px;'],
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key)
                    {
                        return Html::a('<span class="pe-7s-look"></span>',
                            ['menus/view', 'id' => $model->menu_id], [
                                'title' => Yii::t('yii', 'View'),
                            ]);
                    },
                    'update' => function ($url, $model, $key)
                    {
                        return Html::a('<span class="pe-7s-pen"></span>',
                            ['menus/update', 'id' => $model->menu_id], [
                                'title' => Yii::t('yii', 'Update'),
                            ]);
                    },
                    'delete' => function ($url, $model, $key)
                    {
                        return Html::a('<span class="pe-7s-trash"></span>',
                            ['menus/delete', 'id' => $model->menu_id], [
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
