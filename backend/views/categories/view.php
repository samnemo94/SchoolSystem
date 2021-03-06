<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\categories */

$this->title = $model->category_title;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Insert', ['insert', 'id' => $model->category_id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->category_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->category_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

    </p>


    <div class="content table-responsive table-full-width">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <?php
                foreach ($dataFields as $field)
                {
                    if ($field['has_translate'])
                    {
                        foreach ($langs as $lang)
                        {
                            echo '<th>' . $field['field_title'].'_'.$lang->language_code . '</th>';
                        }
                    }
                    else
                        echo '<th>' . $field['field_title'] . '</th>';
                } ?>
                <th>

                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($dataItems as $item)
            {
                if ($item->deleted == 1)
                {
                    echo '<tr bgcolor="#F7CACE">';
                }
                else
                {
                    echo '<tr>';
                }

                foreach ($dataFields as $field)
                {
                    if ($field['has_translate'])
                    {
                        foreach ($langs as $lang)
                        {
                            $value = \backend\models\Values::find()->where(['item_id' => $item['item_id'],'field_id'=>$field['field_id'],'language_id'=>$lang->language_id])->one();
                            echo '<td>';
                            if ($value)
                            {
                                echo $value['value'];
                            }
                            echo '</td>';
                        }
                    }
                    else
                    {
                        $value = \backend\models\Values::find()->where(['item_id' => $item['item_id'],'field_id'=>$field['field_id']])->one();
                        echo '<td>';
                        if ($value)
                        {
                            echo $value['value'];
                        }
                        echo '</td>';
                    }

                }

                echo '<td>';
                if ($item->deleted != 1)
                {
                    echo Html::a('<span class="pe-7s-pen"></span>',
                        ['categories/update-row', 'id' => $item->item_id], [
                            'title' => Yii::t('yii', 'Update'),
                        ]);
                    echo Html::a('<span class="pe-7s-trash"></span>',
                        ['categories/delete-row', 'id' => $item->item_id], [
                            'title' => Yii::t('yii', 'Delete'),
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]);
                }
                echo '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>


</div>
