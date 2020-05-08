<?php

/**
 *
 */

use Illuminate\Support\Facades\Route;

if(! function_exists('isActive')){
    function isActive($href, $class = 'active')
    {
        return $class = (strpos(Route::currentRouteName(), $href) === 0 ? $class : '');
    }
}

/**
 *
 */
if (! function_exists('array_obj')) {

    function array_obj($array)
    {
        return json_decode(json_encode($array));
    }
}

/**
 *
 */
if (! function_exists('set_selected')) {

    function set_selected($field, $value)
    {
        return $field != $value ?: 'selected';
    }
}

/**
 *
 */
if (! function_exists('set_checked')) {

    function set_checked($field, $value)
    {
        return $field != $value ?: 'checked';
    }
}

/**
 *
 */
if (! function_exists('money_db')) {

    function money_db($value)
    {
        return str_replace(['.', ','], ['', '.'], $value);
    }
}

/**
 *
 */
if (! function_exists('money_br')) {

    function money_br($value)
    {
        return $value ? number_format($value, 2, ',', '.') : '0,00';
    }
}

/**
 *
 */
if (! function_exists('icon_status')) {

    function icon_status(int $status)
    {
        $icon = $status == 1
            ? ['icon' => 'check', 'color' => 'text-success']
            : ['icon' => 'times', 'color' => 'text-danger'];

        echo vsprintf('<i class="fa fa-%s %s"></i>', $icon);
    }
}

if (! function_exists('date_br')) {
    function date_br($date)
    {
        return date('d/m/Y', strtotime($date));
    }
}
