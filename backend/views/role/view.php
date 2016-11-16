<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Role */

$this->title = "Role: " . $model->role_name;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$num_of_groups = (int)(sizeof($dataProvider) / 2);
if (sizeof($dataProvider) % 2)
    $num_of_groups++;
$num_of_buttons = 0;
$i = 0;
$max = 0;
foreach ($dataProvider as $value)
{
    $i++;
    if ($i > 2)
    {
        $num_of_buttons += (int)($max / 2);
        if ($max % 2)
            $num_of_buttons++;
        $i = 1;
        $max = 0;
    }
    if (sizeof($value) > $max)
    {
        $max = sizeof($value);
    }
}
$num_of_buttons += (int)($max / 2);
if ($max % 2)
    $num_of_buttons++;
$big_screen = (30 + 10) + $num_of_groups * (13 + 1 + 13 + 13 + 1 + 13) + $num_of_buttons * (45);

$num_of_buttons = 0;
foreach ($dataProvider as $value)
{
    $num_of_buttons += (int)(sizeof($value) / 2);
    if (sizeof($value) % 2)
        $num_of_buttons++;
}
$small_screen = (30 + 10) + sizeof($dataProvider) * (13 + 1 + 13 + 13 + 1 + 13) + $num_of_buttons * (45);
?>

<style>
    .div-background-fill {
        min-height: <?= $small_screen ?>px;
    }

    @media only screen and (min-width: 1620px) {
        .div-background-fill {
            min-height: <?= $big_screen ?>px;
        }
    }
</style>

<div class="role-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->role_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->role_id], [
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
            'role_name',
            [
                'label' => 'Created By',
                'value' => $model->getCreatedBy()->one() ? $model->getCreatedBy()->one()->username : '',
            ],
            'created_at',
            [
                'label' => 'Updated By',
                'value' => $model->getUpdatedBy()->one() ? $model->getCreatedBy()->one()->username : '',
            ],
            'updated_at',
            [
                'label' => 'Deleted By',
                'value' => $model->getDeletedBy()->one() ? $model->getCreatedBy()->one()->username : '',
            ],
            'deleted_at',
        ],
    ]) ?>


    <div class="div-background-fill">
        <h3>Permissions</h3>

        <?php
        foreach ($dataProvider as $key => $value)
        {
            ?>
            <div class="permissions-group">
                <h3><?= ucfirst($key) ?></h3>

                <?php
                foreach ($value as $val)
                {
                    ?>
                    <div class="permission-btn-group">
                        <span
                            class="before-permission-btn <?= array_key_exists($val['permission_id'], $checked) ? 'plus' : 'minus' ?>">
                            <span class="bar1"></span>
                            <span class="bar2"></span>
                        </span>
                        <button class="btn btn-default permission-btn"><?= $val['permission_action'] ?></button>
                        <div class="clear"></div>
                    </div>
                    <?php
                }
                ?>

                <div class="clear"></div>
            </div>
            <?php
        }
        ?>
    </div>

</div>
