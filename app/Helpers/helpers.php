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

if (! function_exists('left_zero')) {

   function left_zero($value, $qty = 11)
   {
       return str_pad($value, $qty, 0, STR_PAD_LEFT);
   }
}

/**
 *
 */
if (! function_exists('document_db')) {

   function document_db($value = null)
   {
       $document = preg_replace("/\D/", '', $value);
       $lenght = strlen($document) <= 11 ?: 14;

       return $value ? left_zero($document, $lenght) : null;
   }
}

/**
 *
 */
if (! function_exists('document_view')) {

   function document_view($value)
   {
       $document = preg_replace("/\D/", '', $value);

       if (strlen($document) == 11) {
           return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $document);
       }

       return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $document);
   }
}

