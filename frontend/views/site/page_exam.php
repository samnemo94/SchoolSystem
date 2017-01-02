<?php

/* @var $this yii\web\View */
/* @var $item backend\models\ItemLanguage */

use yii\helpers\Html;

$this->title = $item['title']['value'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="row">
        <div class="col-sm-8">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <?php
        if (array_key_exists('image',$item) && $item['image']['value'] != '')
        {
            ?>
            <div class="col-sm-4">
                <img width="50%" src="../../backend/web/<?= $item['image']['value'] ?>">
            </div>
            <?php
        }
        ?>
    </div>

        <div class="row">
            Date: <?= $item['exam_date']['value'] ?>
            <br>
            Template: <a href="<?= \yii\helpers\Url::to(['/site/page','id'=>$template['item_id']]) ?>"><?= $template['title']['value'] ?></a>
        </div>


</div>

<br><br>

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
                                <div style="margin-top: 15px" align="center" class="header"><?= $val['title']['value'] ?></div>
                                <div class="description">

                                </div>
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
