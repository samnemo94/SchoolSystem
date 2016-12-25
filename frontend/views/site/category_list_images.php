<div class="card-columns">
    <?php
    foreach ($rows as $row)
    {
        ?>
        <div class="card">
            <div class="card-header bg-white text-xs-center">
                <h4 class="card-title"><a href="<?= \yii\helpers\Url::to(['/site/page', 'id' => $row['item_id']]) ?>"><?= $row['title']['value'] ?></a></h4>
            </div>
            <a href="<?= \yii\helpers\Url::to(['/site/page', 'id' => $row['item_id']]) ?>">
                <img src="<?= $row['image']['value'] ?>" alt="image" style="width:100%;">
            </a>
            <div class="card-block">
                <?= substr($row['description']['value'],0,100) ?> ...<br>
            </div>
        </div>
        <?php
    }
    ?>
</div>