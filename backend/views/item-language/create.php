<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ItemLanguage */

$this->title = 'Create Item Language';
$this->params['breadcrumbs'][] = ['label' => 'Item Languages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-language-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
