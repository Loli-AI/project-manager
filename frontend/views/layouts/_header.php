<?php
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$url = explode("/", Yii::$app->request->url);
$mainUrl = "/" . $url[1];
$domain = $mainUrl;

    NavBar::begin([
        'brandLabel' => '<i class="fas fa-mug-hot"></i>&nbsp;&nbsp;App',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'shadow navbar-expand-lg navbar-light bg-light sticky-top'
        ],
    ]);
    ?>
    <?php if (!Yii::$app->user->isGuest) : ?>
        <?php if ((Yii::$app->request->url == $domain . "/site/forum") || (Yii::$app->request->url == $domain . "/site/forum/")) : ?>
                <form onsubmit="searchProjects(event)" style="width:30%" class="mb-3 mt-3">
                    <div class="position-relative" data-placement="bottom" id="searchProjects" data-toggle="popover" data-html="true" data-content="">
                        <abbr title="Cari Projek">
                            <button type="submit" class="btn btn-dark position-absolute" style="right:0"><i class="fas fa-search"></i></button>
                        </abbr>
                        <input type="text" autocomplete="off" placeholder="Cari Projek" class="form-control" id="search" list="projects">
                    </div>
                    <datalist id="projects"></datalist>
                </form>
        <?php endif; ?>
    <?php endif; ?>

    <?php
    
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '<i class="fas fa-user"></i>&nbsp;&nbsp;Daftar', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => '<i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;Masuk', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => '<i class="fas fa-clipboard-list"></i>&nbsp;&nbsp;Projek', 'url' => ['/site/forum']];
        $menuItems[] = ['label' => '<i class="fas fa-tools"></i>&nbsp;&nbsp;Akun', 'url' => ['/site/account']];

        $menuItems[] = [
            'label' => '<i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;Keluar ('.Yii::$app->user->identity->username.')',
            'url' => ['/site/logout'],
            'linkOptions' => [
                'data-method' => 'post'
            ],
        ];

        

    }
    
    echo Nav::widget([
        'options' => ['class' => 'nav-pills nav-fill ml-auto'], 
        'items' => $menuItems,
        'encodeLabels' => false,
    ]);

    ?>

    <?php
        NavBar::end();
    ?>