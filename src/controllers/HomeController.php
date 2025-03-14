<?php

class HomeController {
    public function index() {
        $view = new ViewController();
        $view->render('home');
    }
}

?>