<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\categoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Categories', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=> function($model){
                        if ($model->deleted== 1){
                            return ['class'=>'danger'];
                        }

        },
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['style' => 'width:30px;'],
            ],
            [
                'attribute' => 'category_title',
                'format' => 'raw',
                'value' =>  function ($dataProvider) {
                    return Html::a($dataProvider['category_title'],
                        ['/categories/view','id' =>$dataProvider['category_id']],
                        ['class' => 'profile-link']);},
            ],
            'category_text',
            'category_text_ar',
            'category_icon',
            [
                'attribute' => 'category_id',
                'label' => 'Parent Category',
                'value' => function ($model)
                {
                    if ($model->parent)
                    {
                        return $model->parent->category_title;
                    }
                    return '-';
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width:50px;'],
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key)
                    {
                        return Html::a('<span class="pe-7s-pen"></span>',
                            ['categories/update', 'id' => $model->category_id], [
                                'title' => Yii::t('yii', 'Update'),
                            ]);
                    },
                    'delete' => function ($url, $model, $key)
                    {
                        return Html::a('<span class="pe-7s-trash"></span>',
                            ['categories/delete', 'id' => $model->category_id], [
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
