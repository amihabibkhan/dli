<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ConfigController extends Controller
{
    public function config()
    {
        Artisan::call('config:cache');
        Artisan::call('route:cache');
        return 'Success';
    }
}
