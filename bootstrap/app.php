<?php

require __DIR__."/../vendor/autoload.php";

$app = new \Chatbox\HttpAuth\Application(__DIR__."/../");

return $app;