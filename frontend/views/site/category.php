<div class="ui items">
    <?php
    foreach ($rows as $row)
    {
        ?>
        <div class="item">
            <div class="ui tiny image">
                <img src="<?= $row['image']['value'] ?>">
            </div>
            <div class="middle aligned content">
                <a class="header"><?= $row['title']['value'] ?></a>
            </div>
        </div>
    <?php
    } ?>
</div>