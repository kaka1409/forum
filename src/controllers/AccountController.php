<?php

class AccountController {
    public function login() {
        $view = ViewController::getInstance('account_form_layout');
        $view->set('title', 'Login');
        $view->render('login');
    }

    public function register() {
        $view = ViewController::getInstance('account_form_layout');
        $view->set('title', 'Register');
        $view->render('register');
    }
}

?>