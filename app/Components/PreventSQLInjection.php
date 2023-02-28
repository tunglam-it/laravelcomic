<?php

namespace App\Components;

class PreventSQLInjection
{
    function preventSQL($value, $char = '\\'){
        return str_replace(
            [$char, '%', '_'],
            [$char.$char, $char.'%', $char.'_'],
            $value
        );
    }
}
