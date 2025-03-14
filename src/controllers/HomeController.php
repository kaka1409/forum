<?php

class HomeController {
    public function index() {
        $view = ViewController::getInstance();
        $view->set('title', 'Home Page');
        $view->render('home');
    }
}

?>