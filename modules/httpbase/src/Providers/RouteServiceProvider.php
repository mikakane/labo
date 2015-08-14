<?php
namespace Chatbox\HttpBase\Providers;

use Chatbox\HttpBase\Http\Controllers\ControllerInfo;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /** @var Application $app */
        $app = $this->app;

        $app->group([
            'prefix' => 'app',
            'middleware' => 'appToken'
        ], function () use($app) {
            // ClientTokenAPI
            $app->post("info",ControllerInfo::class."@fire");
        });
    }
}
