<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\BasketAsset;
BasketAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header>
    <nav class="navbar navbar-light bg-faded">
        <a class="navbar-brand" href="#">КУПИ ДОМОЙ</a>
        <a class="btn btn-outline-primary float-xs-right">Покупки <span class="tag tag-pill tag-default">n</span></a>
    </nav>
</header>
<?= $content ?>
<footer class="container-fluid bg-faded mt-3 py-2">
    <p>copyright</p>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
