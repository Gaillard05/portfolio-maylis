<?php
    require '../app/config/autoload.php';
    require '../app/services/router.php';
    require '../app/controllers/home/HomeController.php';
    require '../app/controllers/projet/ProjetController.php';
    

    $router = new Router();
    $router->loadFromIni('../app/config/routes.ini');
    $router->dispatch();
?>