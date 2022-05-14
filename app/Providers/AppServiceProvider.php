<?php

namespace App\Providers;

use App\Course;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Rakibhstu\Banglanumber\NumberToBangla;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // all course list for all frontend view for menu
        view()->composer('*', function ($view){
            // get all course from database
            $courses = Course::all();

            $bangla_number =  new NumberToBangla();
            $view->with('menu_course_list', $courses)->with('bangla_number', $bangla_number);
        });
    }
}
