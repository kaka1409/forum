<?php

class AdminController {
    public function dashboard() {
        $view = ViewController::getInstance();
        $view->set('title', 'Admin dashboard');
        $view->set('disable_scroll', false);
        $view->render('admin_dashboard');
    }
}

?>