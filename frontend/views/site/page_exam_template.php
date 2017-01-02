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
                    $ii = 0;
                    foreach ($value['data'] as $key => $val)
                    {
                        ?>
                        <div class="card">
                            <a href="<?= \yii\helpers\Url::to(['/site/page', 'id' => $key]) ?>" class="content">
                                <div align="center" class="header"><?= 'Q'.$val['order']['value'] ?></div>
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

</div>
