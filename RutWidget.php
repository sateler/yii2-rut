<?php

namespace sateler\rut;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class RutWidget extends \yii\widgets\InputWidget {
    protected $_pluginName = 'rutWidget';
    
    public $options = [
        'class' => 'form-control',
    ];
    
    public function init() {
        parent::init();
        $this->registerAssets();
        $this->addDataOptions();
    }

    public function registerAssets() {
        
        $view = $this->getView();
        RutWidgetAsset::register($view);
    }
    
    private function addDataOptions() {
        $this->options = ArrayHelper::merge($this->options, [
            'data-rut' => 'true',
        ]);
    }
    
    public function run() {
        return $this->renderInput();
    }
    
    /**
     * Render input for formatted value
     */
    protected function renderInput()
    {
        //Html::addCssClass($this->_inputOptions, 'form-control');
        
        $this->addDataOptions();
        
        $input = $this->hasModel() ?
            Html::activeTextInput($this->model, $this->attribute, $this->options) :
            Html::textInput($this->name, $this->value, $this->options);
        return $input;
    }
}