<nav class="navbar navbar-default navbar-fixed">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?= $this->title; ?></a>
        </div>
        <div class="collapse navbar-collapse">
            <?php
            if (!Yii::$app->user->isGuest)
            {
                ?>

                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <?= \yii\helpers\Html::a(
                            'Log Out',
                            ['/site/logout'],
                            ['data-method' => 'post']

                        )
                        ?>
                    </li>
                </ul>
                <?php
            }
            else
            {
                ?>
                <ul class="nav navbar-nav navbar-right">

                    <li>
                        <?= \yii\helpers\Html::a(
                            'Log In',
                            ['/site/login']
                        )
                        ?>
                    </li>
                </ul>
            <?php
            }
            ?>
        </div>
    </div>
</nav>