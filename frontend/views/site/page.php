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
        if (array_key_exists('image',$item))
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
        <?= $item['description']['value'] ?>
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
                echo "<h2>$key : </h2>";
                foreach ($value as $key => $val)
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


</div>
