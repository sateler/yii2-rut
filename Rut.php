<?php

namespace sateler\rut;

class Rut
{
    /** The separator to use for thousands
     */
    const DIGIT_SEPARATOR = '.';
    
    public static function equal($rut1, $rut2)
    {
        return self::extractNumber($rut1) == self::extractNumber($rut2)
            && self::extractDV($rut1) == self::extractDV($rut2);
    }

    public static function extractDV($rut)
    {
        $trimmed = self::normalize($rut);
        return strtoupper(substr($trimmed, -1));
    }

    public static function extractNumber($rut)
    {
        $trimmed = self::normalize($rut);
        return substr($trimmed, 0, -1);
    }

    /** Removes any rut extra characters, and lowercases the result
     * 
     * @param string $value
     * @return string
     */
    public static function normalize($value)
    {
        // If null do nothing
        if(is_null($value)) {
            return null;
        }
        
        // Clean all non-number or kK
        $clean = strtoupper(preg_replace('/[^0-9kK]/i', '', $value));
        
        // If empty, return empty
        if(strlen($clean) == 0) {
            return "";
        }

        // Trim left 0's
        $trimmed = ltrim($clean, "0");
        if(strlen($trimmed) < 2) {
            $trimmed = str_pad($trimmed, 2, "0", STR_PAD_LEFT);
        }
        
        return strtoupper($trimmed);
    }
    
    public static function format($val)
    {
        if(is_null($val) || $val === '') {
            return null;
        }
        
        $normalized_rut = self::normalize($val);
        
        $number = self::extractNumber($normalized_rut);
        $verifier = self::extractDV($normalized_rut);

        return number_format($number, 0, ',', self::DIGIT_SEPARATOR) . '-' . strtoupper($verifier);
    }
}
