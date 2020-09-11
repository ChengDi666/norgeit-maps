<?php

namespace Norgeit\Maps;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Norgeit\Maps\Http\Middleware\Authorize;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.      引导任何应用程序服务
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'maps');

        $this->app->booted(function () {
            $this->routes();
        });

         (function (ServingNova $event) {
            //
        });
    }


    /** 
     * Register the tool's routes.      注册工具的路由
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova', Authorize::class])
                ->prefix('nova-vendor/maps')
                ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Register any application services.       注册任何应用程序服务
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
