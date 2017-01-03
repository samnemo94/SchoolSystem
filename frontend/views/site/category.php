<div class="ui items">
    <?php
    foreach ($rows as $row)
    {
        ?>
        <div class="item">
            <?php
            if (array_key_exists('image',$row))
            {
                ?>
                <div class="ui tiny image">
                    <img src="<?= $row['image']['value'] ?>">
                </div>
            <?php
            }
            ?>
            <?php
            if (array_key_exists('title',$row))
            {
                ?>
                <div class="middle aligned content">
                    <a class="header"><?= $row['title']['value'] ?></a>
                </div>
                <?php
            }
            ?>

        </div>
    <?php
    } ?>
</div>