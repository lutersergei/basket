<?php

/* @var $this yii\web\View */
/* @var $cat \app\models\Baskets[] */

$this->title = 'My Yii Application';
foreach ($cat as $doc)
{
    var_dump($doc['name']);
    echo '<br>';
}
?>
