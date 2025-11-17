<?php

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Router {
    
    private $dispatcher;

    public function __construct() {
        $this->dispatcher = simpleDispatcher(function(RouteCollector $r) {
            $this->defineRoutes($r);
        });
    }

    private function defineRoutes(RouteCollector $r) 
    {
        $r->addRoute('GET', '/', ['HomeController', 'index']);
        $r->addRoute('GET', '/home', ['HomeController', 'index']);
        $r->addRoute('GET', '/accueil', ['HomeController', 'index']);
        $r->addRoute('GET', '/about-me', ['HomeController', 'handleAboutMe']);
        $r->addRoute('GET', '/a-propos', ['HomeController', 'handleAboutMe']);
        $r->addRoute('GET', '/projets', ['HomeController', 'handleProjets']);
        $r->addRoute('GET', '/contact', ['HomeController', 'handleContact']);
        $r->addRoute('GET', '/projet/{slug:[a-zA-Z0-9\-]+}', ['ProjetController', 'show']);
    }

    public function dispatch(string $httpMethod, string $uri)
    {
        return $this->dispatcher->dispatch($httpMethod, $uri);
    }
   
}




?>