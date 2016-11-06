<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RolePermSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Role Perms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-perm-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin();?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'role.role_name',
            'permission.permission_page',
            'permission.permission_action',
        ],

    ]); ?>
    <?php Pjax::end();?>
</div>
