<?php

/* @var $this yii\web\View */
/* @var $item backend\models\ItemLanguage */

use yii\helpers\Html;

$this->title = $item['title']['value'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1 align="center"><?= Html::encode($this->title) ?></h1>
    <div>
        <?php if (array_key_exists('image', $item))
        { ?>
            <img width="100%" src="<?= $item['image']['value'] ?>">
            <?php
        }
        ?>

        <?php
        if ($is_registered)
        {
            ?>

            <div style="padding-top: 150px">
                <?= $item['description']['value'] ?>
            </div>
            <?php
        }
        else
        {
            ?>
            <?php
        }
        ?>
    </div>

    <br><br>
    <?php
    if ($is_registered)
    {
        ?>
        <div>
            <?php
            if (!empty($childs))
            {
                foreach ($childs as $child)
                {
                    foreach ($child as $key => $value)
                    {
                        ?>
                        <h3 class="ui horizontal divider header">
                            <i class=""></i>
                            <?= $key ?>
                        </h3>
                        <div class="ui cards">
                         <?php
                        foreach ($value['data'] as $key => $val)
                        {
                            ?>
                            <div class="card">
                                <a href="<?= \yii\helpers\Url::to(['/site/page', 'id' => $key]) ?>" class="content">
                                    <div align="center" class="header"><?= $val['title']['value'] ?></div>
                                    <div class="description">

                                    </div>
                                </a>
                                <a href="<?= \yii\helpers\Url::to(['/site/update-row','id'=>$val['item_id']]) ?>" class="ui bottom attached button">
                                    <i class="add icon"></i>
                                    Edit
                                </a>
                            </div>

                            <?php
                        }
                        ?>
                            <div class="card">
                                <a href="<?= \yii\helpers\Url::to(['/site/insert','id'=>$value['id'],'fk_id'=>$item['item_id']]) ?>" class="content">
                                    <div style="margin-top: 15px" align="center" class="header">New</div>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                    echo "<br>";
                }
            }
            ?>
        </div>
        <?php
    }
    ?>

</div>
