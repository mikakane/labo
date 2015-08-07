<?php
namespace Chatbox\HttpAuth\Providers;

use Chatbox\HttpAuth\Http\Controllers\ControllerBind;
use Chatbox\HttpAuth\Http\Controllers\ControllerCheckToken;
use Chatbox\HttpAuth\Http\Controllers\ControllerDelete;
use Chatbox\HttpAuth\Http\Controllers\ControllerLogout;
use Chatbox\HttpAuth\Http\Controllers\ControllerRefresh;
use Chatbox\HttpAuth\Http\Controllers\ControllerUnbind;
use Chatbox\HttpAuth\Http\Controllers\ControllerUpdate;
use Illuminate\Support\ServiceProvider;
use Chatbox\HttpBase\Application;

use Chatbox\HttpAuth\Http\Controllers\ControllerLogin;

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

        $app->get("/",ControllerLogin::class."@fire");

        // ClientTokenAPI
        $app->post("/register",ControllerLogin::class."@fire");
        $app->post("/login",ControllerLogin::class."@fire");
        $app->post("/refresh",ControllerRefresh::class."@fire");

        // UserTokenAPI
        $app->post("/checkToken",ControllerCheckToken::class."@fire");
        $app->post("/bind",ControllerBind::class."@fire");
        $app->post("/unbind",ControllerUnbind::class."@fire");
        $app->post("/update",ControllerUpdate::class."@fire");
        $app->post("/logout",ControllerLogout::class."@fire");

        // RootTokenAPI
        $app->post("/delete",ControllerDelete::class."@fire");
        $app->post("/ban",ControllerBan::class."@fire");
        $app->post("/list",ControllerList::class."@fire");

    }
}
