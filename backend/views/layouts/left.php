<?php
use Yii\helpers\Url;
?>
<div class="sidebar" data-color="purple" data-image="img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="http://www.creative-tim.com" class="simple-text">
                <?= Yii::$app->name ?>
            </a>
        </div>

        <?php if (!Yii::$app->user->isGuest)
        {
            ?>
            <ul class="nav">
                <li>
                    <a href="<?= Url::to(['/site']) ?>">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/languages']) ?>">
                        <i class="pe-7s-global"></i>
                        <p>Languages</p>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/categories']) ?>">
                        <i class="pe-7s-network"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/menus']) ?>">
                        <i class="pe-7s-browser"></i>
                        <p>Menus</p>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/items']) ?>">
                        <i class="pe-7s-plugin"></i>
                        <p>Items</p>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/permissions']) ?>">
                        <i class="pe-7s-plugin"></i>
                        <p>Permissions</p>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/role']) ?>">
                        <i class="pe-7s-plugin"></i>
                        <p>Roles</p>
                    </a>
                </li>
            </ul>
            <?php
        }
        ?>
    </div>
</div>