<?php

if (!function_exists('enum_to_string')) {
    function enum_to_string($cases): string
    {
        $enumValues = collect($cases)->pluck('value');

        return $enumValues->map(fn ($enum) => "'" . $enum . "'")->implode(', ');
    }
}