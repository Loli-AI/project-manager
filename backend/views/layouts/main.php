<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Html;

$url = explode("/", Yii::$app->request->url);
$mainUrl = "/" . $url[1];

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" href="<?= $mainUrl; ?>/favicon.ico" sizes="16x16" type="image/png">
    <?php $this->head() ?>
</head>
<body style="background-color:#F3F4F6">
<?php $this->beginBody() ?>

    <?= $this->render("_header"); ?>
    <div class="container pt-3">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
