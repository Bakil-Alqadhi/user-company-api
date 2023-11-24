<?php 
namespace App\Helpers;


class Helper
{
    public static function handleLogo($file) {
        $url = $file->store('logos', 'public');

        return $url;
    }
}