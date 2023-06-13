<?php

namespace App\Helper;

class CaseHelper
{
    public static function snakeToPascalCase(string $string): string
    {
        $underscoresToSpaces = str_replace("_", " ", $string);
        $capitalized = ucwords($underscoresToSpaces);
        return str_replace(" ", "", $capitalized);
    }
}
