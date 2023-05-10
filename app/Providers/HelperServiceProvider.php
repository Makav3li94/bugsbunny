<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{

    public function boot()
    {
        //
    }

    public function register()
    {
        $file = app_path('helpers/helper.php');
        if (file_exists($file)) {
            require_once($file);
        }
    }
}
