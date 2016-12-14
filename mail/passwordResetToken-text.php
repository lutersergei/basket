<?php

/* @var $this yii\web\View */
/* @var $user app\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Привет <?= $user->phone ?>,

Пройдите по ссылке, для сброса пароля:d:

<?= $resetLink ?>
