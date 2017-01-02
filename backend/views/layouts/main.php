<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);

foreach (Yii::$app->session->getAllFlashes() as $key => $message)
{
    if ($key == 'error' || $key == 'success' || $key == 'warning')
    {
        $params = [];
        $params['body'] = (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!';
        $params['showSeparator'] = true;
        $params['pluginOptions'] = [
            'delay' => 500000, //This delay is how long the message shows for
            'placement' => [
                'from' => 'top',
                'align' => 'right',
            ]
        ];
        $params['delay'] = 1;
        $params['type'] = $key;
        if ($key == 'success')
        {
            $params['icon'] = 'fa fa-thumbs-o-up';
            $params['title'] = 'Completed Successfully';
        }
        if ($key == 'error')
        {
            $params['icon'] = 'fa fa-times';
            $params['title'] = 'Operation Failed';
        }
        if ($key == 'warning')
        {
            $params['icon'] = 'fa fa-warning';
            $params['title'] = 'Pay Attention!';
        }
        echo \kartik\growl\Growl::widget($params);
    }
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <link rel="icon" href="university.png">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper">

    <?= $this->render('left.php'); ?>

    <div class="main-panel">

        <?= $this->render('header.php'); ?>

        <div class="content">
            <div style="padding-left: 15px">
                <?= $content ?>
            </div>
        </div>

        <?= $this->render('footer.php'); ?>
    </div>

</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
