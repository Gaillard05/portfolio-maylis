<?php
    require '../app/config/autoload.php';  
    require_once '../app/config/env.php';
    loadEnv('../app/config/.env');
    require '../app/services/router.php';
    require '../app/controllers/home/HomeController.php';
    require '../app/controllers/projet/ProjetController.php';
    

    $router = new Router();
    $router->loadFromIni('../app/config/routes.ini');
    $router->dispatch();
?>