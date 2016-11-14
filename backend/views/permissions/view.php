<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Permissions */

$this->title = "Permission: ".$model->permission_page." ".$model->permission_action;
$this->params['breadcrumbs'][] = ['label' => 'Permissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permissions-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->permission_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->permission_id], [
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
            'permission_page',
            'permission_action',
            'permission_description:ntext',
            [
                'label' => 'Created By',
                'value' => $model->getCreatedBy()->one()?$model->getCreatedBy()->one()->username:'',
            ],
            'created_at',
            [
                'label' => 'Updated By',
                'value' => $model->getUpdatedBy()->one()?$model->getCreatedBy()->one()->username:'',
            ],
            'updated_at',
            [
                'label' => 'Deleted By',
                'value' => $model->getDeletedBy()->one()?$model->getCreatedBy()->one()->username:'',
            ],
            'deleted_at',
        ],
    ]) ?>

</div>
