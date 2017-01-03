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
        <?php if (array_key_exists('image',$item)){ ?>
        <img width="100%" src="<?= $item['image']['value'] ?>">
        <?php
        }
        ?>

        <div style="padding-top: 150px">
        <?= $item['description']['value'] ?>
        </div>
    </div>
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
                        <i class="<?= $value['icon'] ?>"></i>
                        <?= $key ?>
                    </h3>
                    <div class="ui cards">
                        <?php
                        foreach ($value['data'] as $key => $val)
                        {
                            ?>
                            <div class="card">
                                <a href="<?= \yii\helpers\Url::to(['/site/page', 'id' => $key]) ?>" class="content">
                                    <div style="margin-top: 15px" align="center" class="header"><?= $val['title']['value'] ?></div>
                                </a>
                            </div>

                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                echo "<br>";
            }
        }
        ?>
    </div>

</div>
