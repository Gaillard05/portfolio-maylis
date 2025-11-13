<?php

declare(strict_types=1);

spl_autoload_register(function (string $class):void {
    $class = ltrim($class, '\\');

    $mappings = [
        'App\\Services\\' => __DIR__. '/../app/services/router',
        'App\\Controllers\\Home' => __DIR__.'/../app/controllers/home/HomeController',
        'App\\Controllers\\Projet' => __DIR__.'/../app/controllers/projet/ProjetController',
        'App\\Config\\ENV' => __DIR__.'/../app/config/env',
        'App\\Config\\DATABASE' => __DIR__.'/../app/config/database',
        'App\\Models\\ProjetModel' => __DIR__.'/../app/models/ProjetModel',
        'App\\' => '../app',
    ];

    foreach ($mappings as $prefix => $baseDir) {
        if(str_starts_with($class, $prefix)) {
            $relative = substr($class, strlen($prefix));
            $file = $baseDir.str_replace('\\', '/', $relative).'php';

            if (file_exists($file)) {
                require_once $file;
                return;
            }
        }
    }

    error_log("[Autoload] Class introuvable : $class");
});

?>