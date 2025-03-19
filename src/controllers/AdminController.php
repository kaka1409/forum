<?php

class AdminController {
    public function message() {
        $view = ViewController::getInstance();
        $view->set('title', 'Message');
        $view->render('email');
    }

    public function dashboard() {
        $view = ViewController::getInstance('admin_layout');
        $view->set('title', 'Dashboard');
        $view->render('dashboard');
    }
}

?>