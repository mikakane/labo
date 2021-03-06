<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 15/07/28
 * Time: 22:53
 */

namespace Chatbox\HttpBase;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Chatbox\HttpBase\Exceptions\Handler;

use Illuminate\Contracts\Console\Kernel as KernelInterface;
use Chatbox\HttpBase\Console\Kernel;

use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;

use Chatbox\HttpBase\Http\Middleware\AppTokenMiddleware;


class Application extends \Laravel\Lumen\Application{

    public function __construct($basePath = null)
    {
        \Dotenv::load($basePath);
        parent::__construct($basePath); // TODO: Change the autogenerated stub
        $this->setup();
    }

    protected function setup(){
        $this->singleton(ExceptionHandler::class,Handler::class);
        $this->singleton(KernelInterface::class,Kernel::class);

        $this->routeMiddleware([
            "appToken" => AppTokenMiddleware::class
        ]);
    }

    public function artisan(){
        $kernel = $this->make(KernelInterface::class);
        exit($kernel->handle(new ArgvInput, new ConsoleOutput));
    }




}