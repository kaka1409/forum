<?php

class AccountController {
    public function loginForm() {
        $view = ViewController::getInstance('loginLayout');
        $view->set('title', 'Login');
        $view->render('login');
    }

    public function registerForm() {
        $view = ViewController::getInstance('loginLayout');
        $view->set('title', 'Register');
        $view->render('register');
    }
    
    public function login() {
        global $db;

        if (isset($_POST['submit'])) {
            
            $account = Account::login($db);

            if ($account) {
                sendJson([
                    'status' => 'success',
                    'message' => 'Login successfully',
                    'redirect' => BASE_URL . 'home'
                ]);
                exit;
            } else {
                sendJson([
                    'status' => 'error',
                    'message' => 'Invalid email or password',
                ]);
                exit;
            }
        } else {
            sendJson([
                    'status' => 'error',
                    'message' => 'Login failed',
                ]);
            exit;
        }
    }

    public function register() {
        global $db;

        if (isset($_POST['submit'])) {

            $account = Account::register($db);

            if ($account) {
                sendJson([
                    'status' => 'success',
                    'message' => 'Account registered successfully',
                    'redirect' => BASE_URL . 'login'
                ]);
                exit;
            } else {
                sendJson([
                    'status' => 'error',
                    'message' => 'There already exists an account with that email',
                ]);
                exit;
            }
        } else {
            sendJson([
                    'status' => 'error',
                    'message' => 'Account registered failed',
                ]);
            exit;
        }
    }

    public function logout() {
        $session = new Session();
        $session->destroy();

        header('Location: ' . BASE_URL . 'login');
        exit;
    }

    public function showProfile() {
        global $db;
        $uri_array = explode('/', $_SERVER['REQUEST_URI']);
        $account_id = end($uri_array);

        $account = Account::getAccountById($db, $account_id);

        // sendJson(['data' => $account]);

        if (!$account) {
            header('Location: ' . BASE_URL . 'home');
            exit;
        }

        $view = ViewController::getInstance();
        $view->set('title', 'Viewing ' . $account['account_name'] . ' profile');
        $view->set('disable_scroll', true);
        $view->set('account', $account);
        $view->render('profile');
    
    }
}

?>