<?php

use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

$url = explode("/", Yii::$app->request->url);
$path = Yii::$app->request->url;
$mainUrl = "/" . $url[1];

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= $mainUrl; ?>/favicon.png" sizes="16x16" type="image/png">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
    <script type="text/javascript">
        var domain = "<?= $mainUrl; ?>" || "";
        var path = "<?= $path; ?>" || "";
    </script>
</head>
<body style="background-color:#E5E7EB">

<?php $this->beginBody() ?>

    <?= $this->render("_header.php"); ?>
<div class="position-fixed bg-light top-0 w-100 h-100" style="background-image: url(<?=$mainUrl;?>/img/wallpaper.png);background-size: 100%; background-repeat: no-repeat;"></div>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $this->render("_alert.php"); ?>

        <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>