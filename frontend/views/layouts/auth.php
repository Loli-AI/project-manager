<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

$url = explode("/", Yii::$app->request->url);
$path = Yii::$app->request->url;
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
    <link rel="icon" href="<?= $mainUrl; ?>/favicon.png" sizes="16x16" type="image/png">
    <script type="text/javascript">
        var domain = "<?= $mainUrl; ?>" || "";
        var path = "<?= $path; ?>" || "";
    </script>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    
    <?= $this->render("_header.php"); ?>
    <div class="position-fixed bg-light top-0 w-100 h-100" style="background-image: url(<?=$mainUrl;?>/img/wallpaper.png);background-size: 100%; background-repeat: no-repeat;"></div>
    <br>
    <div class="container">
        
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
