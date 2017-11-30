<?php

namespace sateler\rut;

use yii\web\AssetBundle;

/**
 */
class RutValidatorAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';
    
    public $js = [
        'jquery.rut.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
