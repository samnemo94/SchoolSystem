<?php
/**
 * Created by PhpStorm.
 * User: like-
 * Date: 10/21/2016
 * Time: 9:13 AM
 */

function drawButton($menu, $depth)
{
    if (!$menu['hasChild'])
    {
        ?>
        <li>
            <a <?= $depth > 1 ? 'class="sub-menu"' : '' ?>
                href="<?= \yii\helpers\Url::to(['/site/menu', 'id' => $menu['id']]) ?>">
                <?= $menu['title'] ?>
            </a>
        </li>
        <?php
    }
    else
    {
        ?>

        <li>
            <a <?= $depth > 1 ? 'class="sub-menu"' : '' ?>
                href="<?= \yii\helpers\Url::to(['/site/menu', 'id' => $menu['id']]) ?>">
                <?= $menu['title'] ?>
            </a>

            <ul>
                <?php
                foreach ($menu['children'] as $subMenu)
                {
                    drawButton($subMenu, $depth + 1);
                }
                ?>
            </ul>
        </li>
        <?php
    }
}

?>
<!-- Navbar -->
<nav class="navbar navbar-dark bg-primary navbar-full navbar-fixed-top">

    <!-- Toggle sidebar -->
    <button class="navbar-toggler pull-xs-<?= Yii::$app->language == "ar" ? "right" : "left" ?>" type="button"
            data-toggle="sidebar" data-target="#sidebarLeft"><span class="material-icons">menu</span></button>

    <!-- Brand -->
    <a href="<?= \yii\helpers\Url::to(['/site/index']) ?>" class="navbar-brand"><i class="material-icons">school</i> <?= Yii::$app->name ?></a>

    <!-- Search -->
    <form class="form-inline pull-xs-<?= Yii::$app->language == "ar" ? "right" : "left" ?> hidden-sm-down">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search">
            <span class="input-group-btn"><button class="btn" type="button"><i class="material-icons">search</i>
                </button></span>
        </div>
    </form>
    <!-- // END Search -->


    <div id="primary_nav_wrap">
        <ul>
            <?php
            foreach ($main_menu_top as $menu)
            {
                drawButton($menu, 1);
            }
            ?>
        </ul>
    </div>

    <!-- Menu -->
    <ul class="nav navbar-nav pull-xs-<?= Yii::$app->language == "ar" ? "left" : "right" ?>">
        <?=
        \lajax\languagepicker\widgets\LanguagePicker::widget([
            'skin' => \lajax\languagepicker\widgets\LanguagePicker::SKIN_DROPDOWN,
            'size' => \lajax\languagepicker\widgets\LanguagePicker::SIZE_LARGE
        ]);
        ?>
        <!-- User dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link active dropdown-toggle p-a-0" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false">
                <img src="assets/images/people/50/guy-6.jpg" alt="Avatar" class="img-circle" width="40">
            </a>
            <div
                class="dropdown-menu dropdown-menu-<?= Yii::$app->language == "ar" ? "left" : "right" ?> dropdown-menu-list"
                aria-labelledby="Preview">
                <a class="dropdown-item" href="account-edit.html"><i class="material-icons md-18">lock</i> <span
                        class="icon-text">Edit Account</span></a>
                <a class="dropdown-item" href="profile.html"><i class="material-icons md-18">person</i> <span
                        class="icon-text">Public Profile</span></a>
                <a class="dropdown-item" href="<?= \yii\helpers\Url::to(['/site/logout']) ?>"
                   data-method="post">Logout</a>
            </div>
        </li>
        <!-- // END User dropdown -->

    </ul>
    <!-- // END Menu -->

</nav>
<!-- // END Navbar -->
