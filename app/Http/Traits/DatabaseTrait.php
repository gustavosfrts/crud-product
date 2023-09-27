<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Artisan;

trait DatabaseTrait
{
    public static function refresh() : void
    {
        $base_url = base_path();
        if (PHP_OS_FAMILY === 'Windows')
        {
            shell_exec("call >> {$base_url}/database/database.sqlite");
        }
        else
        {
            shell_exec("touch {$base_url}/database/database.sqlite");
        }
        Artisan::call('migrate:refresh --seed');
    }
}