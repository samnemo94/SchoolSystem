<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\items */

$this->title = $model->item_title;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->item_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->item_id], [
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
            'item_title',
            [
                'label' => 'Category',
                'value' => $model->category?$model->category->category_title:'',
            ],
            [
                'label' => 'Created By',
                'value' => $model->createdBy?$model->createdBy->username:'',
            ],
            'created_at',
            [
                'label' => 'Updated By',
                'value' => $model->updatedBy?$model->updatedBy->username:'',
            ],
            'updated_at',
            [
                'label' => 'Deleted By',
                'value' => $model->deletedBy?$model->deletedBy->username:'',
            ],
            'deleted_at',
        ],
    ]) ?>



    <h2>Item Languages</h2>
    <p>
        <?= Html::a('Add a translation', ['/item-language/create','item_id'=>$model->item_id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $languagesProvider,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['style' => 'width:30px;'],
            ],
            [
                'label'=>'Language',
                'attribute' => 'language_id',
                'value' => function ($model)
                {
                    return $model->language->language_name;
                }
            ],
            'item_title',
            'item_short_description',
            'item_image',

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width:60px;'],
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key)
                    {
                        return Html::a('<span class="pe-7s-look"></span>',
                            ['item-language/view', 'id' => $model->item_language_id], [
                                'title' => Yii::t('yii', 'View'),
                            ]);
                    },
                    'update' => function ($url, $model, $key)
                    {
                        return Html::a('<span class="pe-7s-pen"></span>',
                            ['item-language/update', 'id' => $model->item_language_id], [
                                'title' => Yii::t('yii', 'Update'),
                            ]);
                    },
                    'delete' => function ($url, $model, $key)
                    {
                        return Html::a('<span class="pe-7s-trash"></span>',
                            ['item-language/delete', 'id' => $model->item_language_id], [
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
