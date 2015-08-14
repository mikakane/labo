<?php

require __DIR__."/../vendor/autoload.php";

use Chatbox\HttpBase\Casket\ActiveToken;

$app = new \Chatbox\HttpAuth\Application(__DIR__."/../");


$app->singleton(ActiveToken::class);
$app->register(\Chatbox\App\AppModuleProvider::class);
$app->register(\Chatbox\Auth\AuthModuleProvider::class);

$app->register(\Chatbox\HttpBase\Providers\RouteServiceProvider::class);
$app->register(\Chatbox\HttpAuth\Providers\RouteServiceProvider::class);

return $app;