<?php

class Home extends Controller {
    public function index(): void {
       View::render('home/home', compact('home'));
    }
}

?>