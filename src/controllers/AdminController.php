<?php

class AdminController {
    public function dashboard() {
        global $db;

        $post_count = Post::getPostCount($db);
        $module_count = Module::getModuleount($db);
        $user_count = Account::getUserCount($db);
        $message_count = Message::getMessageCount($db);

        $view = ViewController::getInstance();
        $view->set('title', 'Admin dashboard');
        $view->set('disable_scroll', false);
        $view->set('post_count', $post_count);
        $view->set('module_count', $module_count);
        $view->set('user_count', $user_count);
        $view->set('message_count', $message_count);
        $view->render('admin_dashboard');
    }

    public function user() {
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

    public function userEditForm() {
        if (!isAdmin()) {
            header('Location: ' . BASE_URL . 'home');
            exit;
        }

        $view = ViewController::getInstance();
        $view->set('title', 'Editing user');
        $view->set('disable_scroll', true);
        $view->render('adminUserEditForm');

    }

    public function userDelete() {
        if (!isAdmin()) {
            header('Location: ' . BASE_URL . 'home');
            exit;
        }
    }

    public function post() {
        global $db;

        $posts = Post::getAllPosts($db);

        // sendJson([
        //     'username' => $posts['account_name'],
        //     'avatar' => $posts['account_avatar'],
        //     'email' => $posts['account_email'],
        //     'createDate' =>dateFormat($posts['account_name']),
        // ]);

        sendJson(['posts' => $posts]);
    }

}

?>