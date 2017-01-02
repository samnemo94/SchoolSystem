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

            <ul style="background-color: #d4d4d4">
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
    <a href="<?= \yii\helpers\Url::to(['/site/index']) ?>" class="navbar-brand"><i
                class="material-icons">school</i> <?= Yii::$app->name ?></a>

    <div id="primary_nav_wrap">
        <ul>
            <?php
            foreach ($main_menu_top as $menu)
            {
                if (!$menu['is_private'] || ($menu['is_private'] && !Yii::$app->user->isGuest))
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

        <?php if (!Yii::$app->user->isGuest)
        {
            ?>
            <!-- User dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link active dropdown-toggle p-a-0" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false">
                    <?php
                    if (Yii::$app->user->isStudent)
                    {
                        $img = $GLOBALS['std_profile']['photo']['value'];
                        $name = $GLOBALS['std_profile']['first_name']['value'].' '.$GLOBALS['std_profile']['last_name']['value'];
                    }
                    else
                    {
                        if (Yii::$app->user->isTeacher)
                        {
                            $img = $GLOBALS['tea_profile']['photo']['value'];
                            $name = $GLOBALS['tea_profile']['first_name']['value'].' '.$GLOBALS['tea_profile']['last_name']['value'];
                        }
                        else
                        {
                            $img = 'assets/images/people/50/guy-6.jpg';
                            $name = 'ADMIN';
                        }
                    }
                    ?>
                    <img src="<?= $img ?>" alt="Avatar" class="img-circle" width="40">
                </a>
                <div    class="dropdown-menu dropdown-menu-<?= Yii::$app->language == "ar" ? "left" : "right" ?> dropdown-menu-list"
                        aria-labelledby="Preview">
                    <a class="dropdown-item">
                        <span class="icon-text"><div align="center"><b><?= $name ?></b></div></span></a>

                    <?php
                    if ($name!='ADMIN')
                    {
                        ?>
                    <a class="dropdown-item" href="<?= \yii\helpers\Url::to(['/site/update-user']) ?>"><i
                                class="material-icons md-18">lock</i> <span
                                class="icon-text"><?= Yii::$app->language == "ar" ? "تعديل الحساب" : "Edit Account" ?></span></a>

                        <?php
                    }
                    ?>

                    <?= \yii\helpers\Html::a(
                        'Log Out',
                        ['/site/logout'],
                        ['data-method' => 'post', 'class' => 'dropdown-item']
                    )
                    ?>
                </div>
            </li>
            <!-- // END User dropdown -->

            <?php
        }
        else
        {
            ?>
            <li class="nav-item dropdown">
                <a style="color: #FFF; padding-<?= Yii::$app->language == "ar" ? "left" : "right" ?>: 20px"
                   href=" index.php?r=site/login">
                    <?= Yii::$app->language == "ar" ? "تسجيل الدخول" : "Log In" ?>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link active dropdown-toggle p-a-0" data-toggle="dropdown"
                   href="#">
                    <?= Yii::$app->language == "ar" ? "إنشاء حساب" : "Sign Up" ?>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-<?= Yii::$app->language == "ar" ? "left" : "right" ?> dropdown-menu-list"
                    aria-labelledby="Preview">
                    <?php if (yii::$app->language == 'en') {
                        echo '<a class="dropdown-item" href="'.yii\helpers\Url::to(['/site/signup']).'"><i class="material-icons md-18">person</i> <span
                            class="icon-text">Student</span>
                    </a>';
                        echo '<a class="dropdown-item" href="'.yii\helpers\Url::to(['/site/signup-teacher']).'"><i class="material-icons md-18">person</i> <span
                            class="icon-text">Teacher</span>
                    </a>';
                    }
                    else {
                        echo '<a class="dropdown-item" href="'.yii\helpers\Url::to(['/site/signup']).'"><i class="material-icons md-18">person</i> <span
                            class="icon-text">طالب</span>
                    </a>';

                        echo '<a class="dropdown-item" href="'.yii\helpers\Url::to(['/site/signup-teacher']).'"><i class="material-icons md-18">person</i> <span
                            class="icon-text">استاذ</span>
                    </a>';
                    }
                    ?>

                </div>
            </li>
            <?php
        } ?>

    </ul>
    <!-- // END Menu -->

</nav>
<!-- // END Navbar -->
