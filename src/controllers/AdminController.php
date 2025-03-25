<?php

class AdminController {
    public function dashboard() {
        $view = ViewController::getInstance();
        $view->set('title', 'Admin dashboard');
        $view->render('admin_dashboard');
    }
}

?>