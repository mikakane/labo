<?php

require __DIR__."/../vendor/autoload.php";

$app = new \Chatbox\HttpAuth\Application(__DIR__."/../");


$app->register(\Chatbox\App\AppModuleProvider::class);
$app->register(\Chatbox\Auth\AuthModuleProvider::class);

$app->register(\Chatbox\HttpBase\Providers\RouteServiceProvider::class);
$app->register(\Chatbox\HttpAuth\Providers\RouteServiceProvider::class);

return $app;