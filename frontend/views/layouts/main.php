<?php

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $main_menu_top \yii\db\ActiveRecord[] */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<body class="layout-container ls-top-navbar si-l3-md-up">
<?php $this->beginBody() ?>

    <?= $this->render('header.php',[
        'main_menu_top' => $GLOBALS['main_menu_top'],
    ]); ?>

    <?= $this->render('left.php'); ?>

    <div class="layout-content" data-scrollable>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
