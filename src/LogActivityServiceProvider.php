<?php

namespace Vladi\Landing;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use Vladi\Landing\Http\Middleware\SideLogRequest;

class LogActivityServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('jsonrpcClient', function($app) {
            return new JsonRpcClient();
        });

        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'activitylog');
    }

    public function boot()
    {
        $router = $this->app->make(Router::class);
        $router->pushMiddlewareToGroup('web', SideLogRequest::class);

        Route::group([
            'prefix' => 'web',
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'activitylog');
    }
}
