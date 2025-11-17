<?php
    require '../vendor/autoload.php';  
    use Dotenv\Dotenv;
    $dotenv = Dotenv::createImmutable("../app/config");
    $dotenv->load();
    require '../app/services/router.php';
    require '../app/controllers/home/HomeController.php';
    require '../app/controllers/projet/ProjetController.php';
    
    $httpMethod = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];
    if(false !== $pos = strpos($uri, '?')) $uri = substr($uri, 0, $pos);
    $uri = rawurldecode($uri);


    $router = new Router();
    $routerInfo = $router->dispatch($httpMethod, $uri);

    switch($routerInfo[0]) {
        case FastRoute\Dispatcher::NOT_FOUND:
            http_response_code(404);
            echo "Page non trouvée";
            break;
        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            http_response_code(405);
            echo "Méthode non autorisée";
            break;
        case FastRoute\Dispatcher::FOUND:
            [$class, $method] = $routerInfo[1];
            $vars = $routerInfo[2];
            $controller = new $class();
            call_user_func_array([$controller, $method], $vars);
            break;
    }
   
?>