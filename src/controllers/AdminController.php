<?php

class AdminController {
    public function dashboard() {
        adminAuth();

        global $db;
        $post_count = Post::getPostCount($db);
        $module_count = Module::getModuleCount($db);
        $user_count = Account::getUserCount($db);
        $message_count = Message::getMessageCount($db);

        $posts = Post::getAllPosts($db);

        $view = ViewController::getInstance();
        $view->set('title', 'Admin dashboard');
        $view->set('disable_scroll', false);
        $view->set('post_count', $post_count);
        $view->set('module_count', $module_count);
        $view->set('user_count', $user_count);
        $view->set('message_count', $message_count);
        $view->set('posts', $posts);
        $view->render('admin_dashboard');
    }

    public function user() {
        adminAuth();

        global $db;
        $users = Account::getAllAccounts($db);
        
        // formating user's data
        foreach($users as &$user) {
            // date format
            $user['create_at'] = dateFormat($user['create_at']);
            $user['create_date'] = $user['create_at'];
            unset($user['create_at']);

            // user role format
            $user['role_id'] = $user['role_id'] === 2 ? 'admin' : 'student';
            $user['role'] = $user['role_id'];
            unset($user['role_id']);
        }

        // print_r($users);

        sendJson(['users' => $users]);
    }

    public function createUserForm() {
        adminAuth();

        $view = ViewController::getInstance();
        $view->set('title', 'Create a new user');
        $view->set('disable_scroll', true);
        $view->render('adminUserCreateForm');
    }

    public function userEditForm() {
        adminAuth();

        global $db;
        $uri_array = explode('/', $_SERVER['REQUEST_URI']);
        $accout_id = end($uri_array);

        $account = Account::getAccountById($db, $accout_id);

        $view = ViewController::getInstance();
        $view->set('title', 'Editing user');
        $view->set('disable_scroll', true);
        $view->set('account', $account);
        $view->render('adminUserEditForm');

    }

    public function createUser() {
        adminAuth();

        global $db;

        if (isset($_POST['submit'])) {

            $result = Account::createAccount($db);
    
            if ($result) {
                header('Location: ' . BASE_URL . 'admin');
                exit;
            } else {
                header('Location: ' . BASE_URL . 'admin/user/create');
                exit;
            }
        } else {
            header('Location: ' . BASE_URL . 'admin/user/create');
            exit;
        }

    }

    public function editUser() {
        adminAuth();

        global $db;
        $uri_array = explode('/', $_SERVER['REQUEST_URI']);
        $accout_id = end($uri_array);

        if (isset($_POST['submit'])) {
            
            $result = Account::updateAccount($db, $accout_id);

            if ($result) {
                header('Location: '. BASE_URL . 'admin');
                exit;
            } else {
                header('Location: '. BASE_URL . 'admin/user/edit/' . $accout_id);
                exit;
            }

        } else {
            header('Location: '. BASE_URL . 'admin/user/edit/' . $accout_id);
            exit;
        }
    }

    public function deleteUser() {
        adminAuth();

        global $db;
        $uri_array = explode('/', $_SERVER['REQUEST_URI']);
        $account_id = end($uri_array);

        Account::deleteAccount($db, $account_id);

        header('Location: '. BASE_URL . 'admin');
        exit;
    }

    public function module() {
        adminAuth();

        global $db;
        $modules = Module::getAllModules($db);

        foreach($modules as &$module) {
            $module_id = $module['module_id'];
            $post_count = Module::countPostById($db, $module_id);

            $module['post_count'] = $post_count['post_count'];
        }

        sendJson(['modules' => $modules]);

    }

    public function createModuleForm() {
        adminAuth();

        $view = ViewController::getInstance();
        $view->set('title', 'Editing a module');
        $view->set('disable_scroll', true);
        $view->render('adminModuleCreateForm');
    }

    public function createModule() {
        adminAuth();

        global $db;

        if (isset($_POST['submit'])) {

            $result = Module::createModule($db);

            if ($result) {
                header('Location: ' . BASE_URL . 'admin');
                exit;
            } else {
                header('Location: ' . BASE_URL . 'admin/module/create');
                exit;
            }
        } else {
            header('Location: ' . BASE_URL . 'admin/module/create');
            exit;
        }
    }

    public function moduleEditForm() {
        adminAuth();

        global $db;
        $uri_array = explode('/', $_SERVER['REQUEST_URI']);
        $module_id = end($uri_array);

        $module = Module::getModuleById($db, $module_id) ?? false;

        $view = ViewController::getInstance();
        $view->set('title', 'Editing a module');
        $view->set('disable_scroll', true);
        $view->set('module', $module);
        $view->render('adminModuleEditForm');
    }

    public function editModule() {
        adminAuth();

        global $db;
        $uri_array = explode('/', $_SERVER['REQUEST_URI']);
        $module_id = end($uri_array);

        if (isset($_POST['submit'])) {

            $result = Module::updateModule($db, $module_id);

            if ($result) {
                header('Location: ' . BASE_URL . 'admin');
                exit;
            } else {
                header('Location: ' . BASE_URL . 'admin/module/edit' . $module_id);
                exit;
            }
        } else {
            header('Location: ' . BASE_URL . 'admin/module/edit' . $module_id);
            exit;
        }

    }

    public function deleteModule() {
        adminAuth();

        global $db;
        $uri_array = explode('/', $_SERVER['REQUEST_URI']);
        $module_id = end($uri_array);

        Module::deleteModule($db, $module_id);

        header('Location: ' . BASE_URL . 'admin');
        exit;
    }

    public function post() {
        adminAuth();

        global $db;
        $posts = Post::getAllPosts($db);

        foreach ($posts as &$post) {
            $post['post_at'] = dateFormat($post['post_at']);
        }

        sendJson(['posts' => $posts]);
    }

}

?>