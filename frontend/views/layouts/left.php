<?php
/**
 * Created by PhpStorm.
 * User: like-
 * Date: 10/21/2016
 * Time: 9:39 AM
 */


function drawButtonLeft($menu, $depth)
{
    if (!$menu['hasChild'])
    {
        ?>
        <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" <?= $depth > 1 ? 'style="padding-left: 35px;"' : '' ?>
                href="<?= \yii\helpers\Url::to(['/site/menu', 'id' => $menu['id']]) ?>">
                <i class="sidebar-menu-icon material-icons">account_box</i>
                <?= $menu['title'] ?>
            </a>
        </li>
        <?php
    }
    else
    {
        ?>

        <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="">
                <i class="sidebar-menu-icon material-icons">account_box</i> <?= $menu['title'] ?>
            </a>
            <ul class="sidebar-submenu sm-condensed">
                <?php
                foreach ($menu['children'] as $subMenu)
                { ?>
                        <?=  drawButtonLeft($subMenu, $depth + 1);?>
                <?php  }
                ?>
            </ul>
        </li>
        <?php
    }
}
?>
<!-- Sidebar -->
<div style="background-color: #ececec !important;" class="sidebar sidebar-<?= Yii::$app->language == "ar"?"right":"left" ?> sidebar-light sidebar-visible-md-up si-si-3 ls-top-navbar-xs-up sidebar-transparent-md" id="sidebarLeft" data-scrollable>
    <div class="sidebar-heading"><?= Yii::$app->language == "ar" ? "القائمة الرئيسية" : "Main Menu" ?></div>
    <ul class="sidebar-menu">
        <?php
        foreach ($main_menu_left as $menu)
        {
            drawButtonLeft($menu, 1);
        }
        ?>
    </ul>
</div>
<!-- // END Sidebar -->

