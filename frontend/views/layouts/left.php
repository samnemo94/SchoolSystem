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
        <li class="sidebar-menu-item active">
            <a <?= $depth > 1 ? 'class="sub-menu"' : '' ?>
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
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="">
                        <i class="sidebar-menu-icon material-icons">tune</i> <?= $menu['title'] ?>
                    </a>
                    <ul class="sidebar-submenu sm-condensed">
                        <?php
                        foreach ($menu['children'] as $subMenu)
                        { ?>
                            <li class="sidebar-menu-item">
                                <?=  drawButtonLeft($subMenu, $depth + 1);?>
                            </li>
                        <?php  }
                        ?>
                    </ul>
                </li>
            </ul>

        <?php
    }
}
?>
<!-- Sidebar -->
<div class="sidebar sidebar-<?= Yii::$app->language == "ar"?"right":"left" ?> sidebar-light sidebar-visible-md-up si-si-3 ls-top-navbar-xs-up sidebar-transparent-md" id="sidebarLeft" data-scrollable>
    <div class="sidebar-heading"><?= Yii::$app->language == "ar" ? "القائمة الرئيسية" : "Main Menu" ?></div>
    <ul class="sidebar-menu">
        <?php
        foreach ($main_menu_left as $menu)
        {
            drawButtonLeft($menu, 1);
        }
        ?>
<!--        <li class="sidebar-menu-item active">-->
<!--            <a class="sidebar-menu-button" href="">-->
<!--                <i class="sidebar-menu-icon material-icons">account_box</i> Teachers-->
<!---->
<!--            </a>-->
<!--            <ul class="sidebar-submenu sm-condensed">-->
<!--                <li class="sidebar-menu-item">-->
<!--                    <a class="sidebar-menu-button" href="">-->
<!--                        <i class="sidebar-menu-icon material-icons">school</i> All Teachers-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="sidebar-menu-item">-->
<!--                    <a class="sidebar-menu-button" href="">-->
<!--                        <i class="sidebar-menu-icon material-icons">school</i> Pending Requests-->
<!--                    </a>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </li>-->
<!--        <li class="sidebar-menu-item active">-->
<!--            <a class="sidebar-menu-button" href="">-->
<!--                <i class="sidebar-menu-icon material-icons">account_box</i> Students-->
<!--            </a>-->
<!--        </li>-->
<!--        <li class="sidebar-menu-item">-->
<!--            <a class="sidebar-menu-button" href="">-->
<!--                <i class="sidebar-menu-icon material-icons">school</i> Normal item-->
<!--            </a>-->
<!--        </li>-->
<!--        <li class="sidebar-menu-item">-->
<!--            <a class="sidebar-menu-button" href="">-->
<!--                <i class="sidebar-menu-icon material-icons">comment</i> Notify right item-->
<!--                <span class="sidebar-menu-label label label-default">2</span>-->
<!--            </a>-->
<!--        </li>-->
    </ul>
    <!-- Components menu -->
<!--    <div class="sidebar-heading">Menu Components</div>-->
<!--    <ul class="sidebar-menu">-->
<!--        <li class="sidebar-menu-item">-->
<!--            <a class="sidebar-menu-button" href="">-->
<!--                <i class="sidebar-menu-icon material-icons">tune</i> Many Components-->
<!--            </a>-->
<!--            <ul class="sidebar-submenu sm-condensed">-->
<!--                <li class="sidebar-menu-item">-->
<!--                    <a class="sidebar-menu-button" href="">-->
<!--                        <i class="sidebar-menu-icon material-icons">school</i> level 2-->
<!--                    </a>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </li>-->
<!--    </ul>-->
    <!-- // END Components Menu -->
<!--    <div class="sidebar-heading">CMS Generated</div>-->
</div>
<!-- // END Sidebar -->

