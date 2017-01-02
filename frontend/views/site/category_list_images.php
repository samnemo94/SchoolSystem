
<div class="ui link cards">
    <?php
    foreach ($rows as $row)
    {
        ?>
        <div class="card" style="height: 300px;">
            <a class="image" href="<?= \yii\helpers\Url::to(['/site/page', 'id' => $row['item_id']]) ?>">
                <img style="height: 200px" src="<?= $row['image']['value'] ?>">
            </a>
            <div class="content">
                <a class="header" href="<?= \yii\helpers\Url::to(['/site/page', 'id' => $row['item_id']]) ?>"><?= $row['title']['value'] ?></a>
                <div class="meta">
                    <a>Last Seen 2 days ago</a>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>