<?php

namespace sateler\rut;

/**
 * Behavior that adds a rut formatter
 *
 * @author felipe
 */
class RutFormatBehavior extends \yii\base\Behavior {
    /** The separator to use for thousands
     */
    public $digitSeparator = '.';

	public function asRut($val) {
        if (!$val) {
            return $this->owner->nullDisplay;
        }
        $val = RutValidator::trimValue($val);
        $sep = strlen($val) - 1;
        $number = substr($val, 0, $sep);
        $verifier = substr($val, $sep);
        
        return number_format($number, 0, ',', $this->digitSeparator) . '-' . strtolower($verifier);
	}
}
