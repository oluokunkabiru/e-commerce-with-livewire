<?php

use App\Models\MyShop;

if (!function_exists('settings')) {
    function settings()
    {
        $config = MyShop::first();
        return $config;
    }
}


?>
