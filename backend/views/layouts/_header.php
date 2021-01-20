<?php
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'shadow navbar-expand-lg navbar-light bg-light'
        ]
    ]);
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '<i class="fas fa-user"></i>&nbsp;&nbsp;Masuk', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => '<i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;Keluar ('.Yii::$app->user->identity->username.')',
            'url' => ['/site/logout'],
            'linkOptions' => [
                'data-method' => 'post'
            ],
        $menuItems[] = [
            'label' => '<i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;Halaman Utama',
            'url' => ['/site/index'],
            ],
        $menuItems[] = [
            'label' => '<i class="fas fa-users"></i>&nbsp;&nbsp;Pengguna',
            'url' => ['/user/index'],
            ],
        $menuItems[] = [
            'label' => '<i class="fas fa-project-diagram"></i>&nbsp;&nbsp;Projek',
            'url' => ['/project/index'],
            ],
        
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'nav-pills nav-fill ml-auto'],
        'items' => $menuItems,
        'encodeLabels' => false,
    ]);
    NavBar::end();
    ?>