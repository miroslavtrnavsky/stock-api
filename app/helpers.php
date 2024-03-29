<?php

if (! function_exists('enum_to_string')) {
    function enum_to_array($cases): array
    {
        return collect($cases)->pluck('value')->toArray();
    }
}

if(! function_exists('generate_numeric_code')) {
    function generate_numeric_code($length): int
    {
        $nbDigits = $length;
        $max = 10 ** $nbDigits - 1;

        return strval(mt_rand(10 ** ($nbDigits - 1), $max));
    }
}