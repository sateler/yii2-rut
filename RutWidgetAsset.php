<?php

namespace sateler\rut;

use yii\web\AssetBundle;

/**
 */
class RutWidgetAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';
    
    public $js = [
        'rut-widget.js',
    ];
    public $depends = [
        'sateler\rut\RutValidatorAsset',
    ];
}
