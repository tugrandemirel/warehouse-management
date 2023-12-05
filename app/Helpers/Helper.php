<?php

use Illuminate\Support\Str;

/**
 * Generate a URL friendly "slug" from a given string.
 *
 * @param string $title
 * @param string $separator
 * @return string
 */
if (!function_exists('str_slug'))
{
    function str_slug($title, $separator = '-')
    {
        $title = str_replace(
            ['ü', 'Ü', 'ö', 'Ö', 'ş', 'Ş', 'ç', 'Ç', 'ı', 'İ', 'ğ', 'Ğ'],
            ['u', 'U', 'o', 'O', 's', 'S', 'c', 'C', 'i', 'I', 'g', 'G'],
            $title
        );

        return Str::slug($title, $separator);
    }
}

if (!function_exists('turkishCharacterChanging'))
{
    function turkishCharacterChanging($title)
    {
        $title = str_replace(
            ['ü', 'Ü', 'ö', 'Ö', 'ş', 'Ş', 'ç', 'Ç', 'ı', 'İ', 'ğ', 'Ğ'],
            ['u', 'U', 'o', 'O', 's', 'S', 'c', 'C', 'i', 'I', 'g', 'G'],
            $title
        );

        return $title;
    }
}

