<?php
/**
 * Created by PhpStorm.
 * User: like-
 * Date: 10/21/2016
 * Time: 9:13 AM
 */
?>

<!-- Navbar -->
<nav class="navbar navbar-dark bg-primary navbar-full navbar-fixed-top">

    <!-- Toggle sidebar -->
    <button class="navbar-toggler pull-xs-right" type="button" data-toggle="sidebar" data-target="#sidebarLeft"><span class="material-icons">menu</span></button>

    <!-- Brand -->
    <a href="index-2.html" class="navbar-brand"><i class="material-icons">school</i> <?= Yii::$app->name ?></a>

    <!-- Search -->
    <form class="form-inline pull-xs-right hidden-sm-down">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search">
            <span class="input-group-btn"><button class="btn" type="button"><i class="material-icons">search</i></button></span>
        </div>
    </form>
    <!-- // END Search -->

    <ul class="nav navbar-nav hidden-sm-down">

        <?php
        foreach ($main_menu_top as $menu)
        {
            if (!$menu->haveChilds())
            {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/menu','id' => $menu->menu_id]) ?>">
                        <?= $menu->menu_title ?>
                    </a>
                </li>
                <?php
            }
            else
            {
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle p-a-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false">
                        <?= $menu->menu_title ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left dropdown-menu-list" aria-labelledby="Preview">
                        <?php
                            foreach ($menu->getMenuses()->all() as $subMenu)
                            {
                                ?>
                                <a class="dropdown-item" href="<?= \yii\helpers\Url::to(['/site/menu','id' => $subMenu->menu_id]) ?>"><?= $subMenu->menu_title ?></a>
                                <?php
                            }
                        ?>
                    </div>
                </li>
                <?php
            }
            ?>

        <?php
        }
        ?>
    </ul>

    <!-- Menu -->
    <ul class="nav navbar-nav pull-xs-left">

        <!-- User dropdown -->
        <div style="float: right">
        <li class="nav-item dropdown">
            <a class="nav-link active dropdown-toggle p-a-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false">
                <img src="assets/images/people/50/guy-6.jpg" alt="Avatar" class="img-circle" width="40">
            </a>
            <div class="dropdown-menu dropdown-menu-left dropdown-menu-list" aria-labelledby="Preview">
                <a class="dropdown-item" href="account-edit.html"><i class="material-icons md-18">lock</i> <span class="icon-text">Edit Account</span></a>
                <a class="dropdown-item" href="profile.html"><i class="material-icons md-18">person</i> <span class="icon-text">Public Profile</span></a>
                <a class="dropdown-item" href="<?= \yii\helpers\Url::to(['/site/logout']) ?>" data-method="post">Logout</a>
            </div>
        </li>
        </div>
        <!-- // END User dropdown -->
        <div style="float: left;padding-left: 20px">
        <?=
        \lajax\languagepicker\widgets\LanguagePicker::widget([
            'skin' => \lajax\languagepicker\widgets\LanguagePicker::SKIN_DROPDOWN,
            'size' => \lajax\languagepicker\widgets\LanguagePicker::SIZE_LARGE
        ]);
        ?>
        </div>
    </ul>
    <!-- // END Menu -->

</nav>
<!-- // END Navbar -->
