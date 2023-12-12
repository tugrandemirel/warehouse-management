<?php

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
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

if (!function_exists('deleteModel'))
{
    function deleteModel(Model $model, $title, $media = null)
    {
        if ($model->getMedia($media)->count() > 0)
        {
            $model->clearMediaCollection($media);
        }
        $delete = $model->delete();
        $success = $title . ' başarıyla silindi.';
        $error = $title . ' silinirken bir hata oluştu.';

        return response()->json([
            'status' => $delete,
            'message' => $delete ? $success : $error
        ]);
    }
}

if(!function_exists('responseJson'))
{
    function responseJson($status, $message, $data = null)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status === true ? 200 : 400);
    }
}

