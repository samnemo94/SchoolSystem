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
    <button class="navbar-toggler pull-xs-left" type="button" data-toggle="sidebar" data-target="#sidebarLeft"><span class="material-icons">menu</span></button>

    <!-- Brand -->
    <a href="index-2.html" class="navbar-brand"><i class="material-icons">school</i> <?= Yii::$app->name ?></a>

    <!-- Search -->
    <form class="form-inline pull-xs-left hidden-sm-down">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search">
            <span class="input-group-btn"><button class="btn" type="button"><i class="material-icons">search</i></button></span>
        </div>
    </form>
    <!-- // END Search -->

    <ul class="nav navbar-nav hidden-sm-down">

        <!-- Menu -->
        <li class="nav-item">
            <a class="nav-link" href="get-help.html">Get Help</a>
        </li>
    </ul>

    <!-- Menu -->
    <ul class="nav navbar-nav pull-xs-right">

        <!-- User dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link active dropdown-toggle p-a-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false">
                <img src="assets/images/people/50/guy-6.jpg" alt="Avatar" class="img-circle" width="40">
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-list" aria-labelledby="Preview">
                <a class="dropdown-item" href="account-edit.html"><i class="material-icons md-18">lock</i> <span class="icon-text">Edit Account</span></a>
                <a class="dropdown-item" href="profile.html"><i class="material-icons md-18">person</i> <span class="icon-text">Public Profile</span></a>
                <a class="dropdown-item" href="<?= \yii\helpers\Url::to(['/site/logout']) ?>" data-method="post">Logout</a>
            </div>
        </li>
        <!-- // END User dropdown -->

    </ul>
    <!-- // END Menu -->

</nav>
<!-- // END Navbar -->