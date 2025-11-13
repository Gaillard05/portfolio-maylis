<?php

class Router {

    private array $routes = [];

    public function loadFromIni(string $filePath): void {

        if(!file_exists($filePath)) {
            throw new \Exception("Fichier INI introuvable : $filePath");
        }

        $data = parse_ini_file($filePath, true);

        foreach ($data as $method => $routes) {
            foreach ($routes as $path => $handler) {
                if(!str_contains($handler, '@')) continue;
                [$controller, $action] = explode('@', $handler);
                $this->routes[strtoupper($method)][$path] = [new $controller(), $action];
            }
        }
    }

    public function dispatch(): void {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = strtok($_SERVER['REQUEST_URI'], '?');

        if(isset($this->routes[$method][$uri])) {
            $callback = $this->routes[$method][$uri];
            [$controller, $action] = $callback;

            if(!method_exists($controller, $action)) {
                http_response_code(500);
                echo "Erreur : méthode '$action' introuvable dans ".get_class($controller);
                return;
            }

            $section = trim($_SERVER['REQUEST_URI'], '/');
            if($section === '') $section = 'home';

            call_user_func([$controller, $action], $section);

            return;
        } 

        if(isset($this->routes[$method])) {
            foreach($this->routes[$method] as $route => [$controller, $action]) {
                if(strpos($route, ':') === false) continue;

                $pattern = preg_replace('/:[^\/]+/', '([^/]+)', $route);
                $pattern = "#^$pattern$#";
                    
                if(preg_match($pattern, $uri, $matches)) {
                    array_shift($matches);
                    call_user_func_array([$controller, $action], $matches);
                    return;
                }

            }
        } 
        
        http_response_code(404);
        require_once "../app/views/erreurs/404.phtml";
       
    } 
   
}




?>