<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\menus */
/* @var $languages_provider \yii\data\ActiveDataProvider */

$this->title = $model->menu_title;
$this->params['breadcrumbs'][] = ['label' => 'Menuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menus-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->menu_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->menu_id], [
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
            'menu_title',
            [
                'label' => 'Parent Menu',
                'value' => $model->parent?$model->parent->menu_title:'',
            ],
            [
                'label' => 'Category',
                'value' => $model->category?$model->category->category_title:'',
            ],
            'menu_position',
            [
                'label' => 'Item',

                'value' => $model->item?$model->item->item_id:'',
            ],
        ],
    ]) ?>

    <h2>Menu Languages</h2>
    <p>
        <?= Html::a('Add a translation', ['/menu-language/create','menu_id'=>$model->menu_id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $languages_provider,
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
            'title',

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width:60px;'],
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key)
                    {
                        return Html::a('<span class="pe-7s-pen"></span>',
                            ['menu-language/update', 'id' => $model->menu_language_id], [
                                'title' => Yii::t('yii', 'Update'),
                            ]);
                    },
                    'delete' => function ($url, $model, $key)
                    {
                        return Html::a('<span class="pe-7s-trash"></span>',
                            ['menu-language/delete', 'id' => $model->menu_language_id], [
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
