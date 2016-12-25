<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class BasketAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/basket';
    public $css = [
        'css/products.css',
        'css/bootstrap.css'
    ];
    public $js = [
        'js/bundle.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}