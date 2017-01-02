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
                echo "<h2>$key : </h2>";
                echo "<a href='".\yii\helpers\Url::to(['/site/insert','id'=>$value['id'],'fk_id'=>$item['item_id']])."'>New</a>";
                $ii = 0;
                foreach ($value['data'] as $key => $val)
                {
                    $ii++;
                    echo Html::a('Q'.$ii, $url = ['/site/page', 'id' => $key]);
                    echo '<br>';
                }
            }
            echo "<br>";
        }
    }
    ?>
</div>


</div>
