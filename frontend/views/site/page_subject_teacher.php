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
                        echo "<h2>$key : </h2>";
                        echo "<a href='".\yii\helpers\Url::to(['/site/insert','id'=>$value['id'],'fk_id'=>$item['item_id']])."'>New</a>";
                        foreach ($value['data'] as $key => $val)
                        {
                            echo Html::a($val['title']['value'], $url = ['/site/page', 'id' => $key]);
                            echo '<br>';
                        }
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
