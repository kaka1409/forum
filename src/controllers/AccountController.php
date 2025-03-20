<?php

class AccountController {
    public function loginForm() {
        $view = ViewController::getInstance('account_form_layout');
        $view->set('title', 'Login');
        $view->render('login');
    }

    public function registerForm() {
        $view = ViewController::getInstance('account_form_layout');
        $view->set('title', 'Register');
        $view->render('register');
    }
    
    public function login() {
        global $db;

        if (isset($_POST['submit'])) {
            
            $account = Account::login($db);

            if ($account) {
                header('Location: ' . BASE_URL . 'home');
                exit;
            } else {
                header('Location: ' . BASE_URL . 'login');
                exit;
            }
        } else {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
    }

    public function register() {
        global $db;

        if (isset($_POST['submit'])) {

            $account = Account::register($db);
            

            if ($account) {
                header('Location: ' . BASE_URL . 'login');
                exit;
            } else {
                header('Location: ' . BASE_URL . 'register');
                exit;
            }
        } else {
            header('Location: ' . BASE_URL . 'register');
            exit;
        }
    }

    public function logout() {
        $session = new Session();
        $session->destroy();
    }

    public function showProfile() {
        $view = ViewController::getInstance();
        $view->set('title', 'Profile');
        $view->render('profile');
    
    }
}

?>