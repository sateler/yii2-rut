<?php

namespace sateler\rut;

use \Yii;
use yii\validators\Validator;

/**
 * Validate a chilean RUT value
 *
 * @author felipe
 */

class RutValidator extends Validator
{
    /** @inheritdoc */
    public $message = 'RUT inválido';

    /** Whether to allow zero (ie, 0-0)
     *
     * @var boolean 
     */
    public $allowZero = true;

    function init() {
        parent::init();
        if(!isset(Yii::$app->i18n->translations['yii2-rut'])) {
            Yii::$app->i18n->translations['yii2-rut'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => dirname(__FILE__) . '/messages',
            ];
        }
    }
    
    public function clientValidateAttribute($model, $attribute, $view) {
        RutValidatorAsset::register($view);
        $msg = json_encode($this->message, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        return "if (typeof(value) === 'string' && value.length != 0 && !jQuery.validateRut(value)) {messages.push($msg);}";
    }
    
    /**
     * @inheritdoc
     */
    public function validateAttribute($object, $attribute)
    {
        $ok = $this->isValid($object->$attribute);
        
        if(!$ok) {
            $message= $this->message !== null ? $this->message : Yii::t('yii2-rut', '{attribute} is not a valid rut', [
                'attribute' => $attribute
            ]);
            $this->addError($object, $attribute, $message);
        }
        
        // Store back as plain
        $object->$attribute = Rut::normalize($object->$attribute);
    }

    public function isValid($val)
    {
        $value = Rut::normalize($val);

        if (!$value) {
            // may be empty
            return true;
        }
        $ok = false;
        $number = Rut::extractNumber($value);
        $verifyCode = Rut::extractDV($value);
        $evaluate = strrev($number);
        $multiply = 2;
        $store = 0;
        for ($i = 0; $i < strlen($evaluate); $i++) {
            $store += $evaluate[$i] * $multiply;
            $multiply++;
            if ($multiply > 7) {
            $multiply = 2;
            }
        }
        if (!$this->allowZero && +$store === 0) {
            return false;
        }
        $result = 11 - ($store % 11);
        if ($result == 10) {
            $result = 'K';
        }
        if ($result == 11) {
            $result = 0;
        }
        if ('' . $verifyCode === '' . $result) {
            $ok = true;
        }
        return $ok;
    }
}
