<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\languages */

$this->title = 'Update Languages: ' . $model->language_id;
$this->params['breadcrumbs'][] = ['label' => 'Languages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->language_id, 'url' => ['view', 'id' => $model->language_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="languages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
