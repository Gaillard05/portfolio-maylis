<?php

class HomeController {
    public function index(string $section='home'): void {
       require '../app/views/home/home.phtml';
    }

    public function handleContact(): void {
        header('location: /contact');
        exit;
    }
}

?>