<?php

function loadEnv($path) 
{
    if(!file_exists($path)) {
        throw new Exception("le fichier .env n'existe pas : $path" );
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach($lines as $line) {
        [$name, $value] = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value, "\t\n\0\x0B\"'");

        $_ENV[$name] = $value;
        putenv("$name=$value");
    }
}