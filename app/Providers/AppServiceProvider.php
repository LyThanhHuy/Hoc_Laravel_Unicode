<?php

namespace App\Providers;

use App\View\Components\Alert;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\Inputs\Button;
use Illuminate\Pagination\Paginator;

// use App\View\Components\Forms\Button as FormButton;

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
        // Blade::directive('datetime', function ($expression) {
        //     $expression = trim($expression, '\'');
        //     $expression = trim($expression, '"');
        //     $dateObject = date_create($expression);
        //     if (!empty($dateObject)) {
        //         $dateFormat = $dateObject->format('d/m/Y H:i:s');
        //         return $dateFormat;
        //     }
        //     return false;
        // });

        Blade::if('env', function ($value) {
            // Trả về biểu thức giá trị boolean
            if (config('app.env') === $value) {
                return true;
            }
            return false;
        });

        Blade::component('package-alert', Alert::class);

        Blade::component('button', Button::class);

        // Blade::component('form-button', FormButton::class);

        Paginator::useBootstrap();
    }
}
