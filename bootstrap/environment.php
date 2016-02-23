<?php
use Dotenv\Dotenv;

$env = $app->detectEnvironment(function () {
    $environmentPath = __DIR__ . '/../.env';
    $setEnv = trim(file_get_contents($environmentPath));
    if(file_exists($environmentPath)) {
        putenv("APP_ENV=$setEnv");
        if(getenv('APP_ENV') && file_exists(__DIR__ . '/../.' . getenv('APP_ENV') . '.env')) {
            $dotenv = new Dotenv(__DIR__ . '/../', '.' . getenv('APP_ENV') . '.env');
            $dotenv->load();
        }
    }
});