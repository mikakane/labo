<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/07/28
 * Time: 22:53
 */

namespace Chatbox\HttpAuth;

use Chatbox\HttpAuth\Providers\RouteServiceProvider;
use Illuminate\Contracts\Debug\ExceptionHandler;


class Application extends \Chatbox\HttpBase\Application{

    public function setup()
    {
        parent::setup();
    }


}