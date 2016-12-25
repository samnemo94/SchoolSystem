<div class="card-columns">
    <?php
    foreach ($rows as $row)
    {
        ?>
        <div class="card">
            <div class="card-header bg-white text-xs-center">
                <h4 class="card-title"><a href="<?= \yii\helpers\Url::to(['/site/page', 'id' => $row['item_id']]) ?>"><?= $row['title'] ?></a></h4>
            </div>
            <a href="<?= \yii\helpers\Url::to(['/site/page', 'id' => $row['item_id']]) ?>">
                <img src="<?= $row['image'] ?>" alt="image" style="width:100%;">
            </a>
            <div class="card-block">
                <?= substr($row['description'],0,100) ?> ...<br>
            </div>
        </div>
        <?php
    }
    ?>
</div>