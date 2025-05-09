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
        $logs = Log::getLogs($db);

        if (!empty($logs)) {
            foreach($logs as &$log) {

                switch ($log['action']) {
                    case 'create': {
                        if ($log['post_title']) {
                            $log['name'] = 'post "' . $log['post_title'] .'"';
                        } else if ($log['module_name']) {
                            $log['name'] = 'module "' . $log['module_name'] . '"';
                        } else if ($log['username']){
                            $log['name'] = 'user "' . $log['username'] . '"';
                        } 

                        break;

                    }

                    case 'update': {
                        if ($log['post_title']) {
                            $log['name'] = 'post "' . $log['post_title'] . '"';
                        } else if ($log['module_name']) {
                            $log['name'] = 'module "' . $log['module_name'] . '"';
                        } else {
                            $log['name'] = 'user "' . $log['username'] . '"';
                        } 

                        break;

                    }

                    case 'delete': {
                        if ($log['post_title']) {
                            $log['name'] = 'post ' . $log['post_title'];
                        } else if ($log['module_name']) {
                            $log['name'] = 'module ' . $log['module_name'];
                        } else {
                            $log['name'] = 'user ' . $log['username'];
                        } 

                        break;
                    }
                };

            }
        }

        $view = ViewController::getInstance();
        $view->set('title', 'Admin dashboard');
        $view->set('disable_scroll', false);
        $view->set('post_count', $post_count);
        $view->set('module_count', $module_count);
        $view->set('user_count', $user_count);
        $view->set('message_count', $message_count);
        $view->set('posts', $posts);
        $view->set('logs', $logs);
        $view->render('adminDashboard');
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
                $pdo = $db->getConnection();
                $user_id = $pdo->lastInsertId();

                // collect admin audit logs
                $log_result = Log::collectLog($db, $user_id, 'create', 'user') ?? null;

                if ($log_result === null || !$log_result) {
                    throw new Error('Failed to collect user log');
                }

                sendJson([
                    'status' => 'success',
                    'message' => 'User created successfully',
                    'redirect' => BASE_URL . 'admin/user_list'
                ]);
                exit;
            } else {
                sendJson([
                    'status' => 'error',
                    'message' => 'Failed to create user',
                    'redirect' => BASE_URL . 'admin/user/create'
                ]);
                exit;
            }
        } else {
            sendJson([
                'status' => 'error',
                'message' => 'Failed to create user',
                'redirect' => BASE_URL . 'admin/user/create'
            ]);
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
                $user_id = $accout_id;

                // collect admin audit logs
                $log_result = Log::collectLog($db, $user_id, 'update', 'user') ?? null;

                if ($log_result === null || !$log_result) {
                    throw new Error('Failed to collect user log');
                }

                sendJson([
                    'status' => 'success',
                    'message' => 'User edited successfully',
                    'redirect' => BASE_URL . 'admin/user_list'
                ]);
                exit;
            } else {
                sendJson([
                    'status' => 'error',
                    'message' => 'Failed to edit user',
                    'redirect' => BASE_URL . 'admin/user/edit/' . $accout_id
                ]);
                exit;
            }

        } else {
            sendJson([
                'status' => 'error',
                'message' => 'Failed to edit user',
                'redirect' => BASE_URL . 'admin/user/edit/' . $accout_id
            ]);
            exit;
        }
    }

    public function deleteUser() {
        adminAuth();

        global $db;
        $uri_array = explode('/', $_SERVER['REQUEST_URI']);
        $account_id = end($uri_array);

        $result = Account::deleteAccount($db, $account_id);

        // if ($result) {
        //     sendJson([
        //         'status' => 'success',
        //         'message' => 'User deleted successfully',
        //     ]);
        // } else {
        //     sendJson([
        //         'status' => 'error',
        //         'message' => 'Failed to delete user',
        //     ]);
        // }

        header('Location: '. BASE_URL . 'admin/user_list');
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
                $pdo = $db->getConnection();
                $module_id = $pdo->lastInsertId();

                // collect admin audit logs
                $log_result = Log::collectLog($db, $module_id, 'create', 'module') ?? null;

                if ($log_result === null || !$log_result) {
                    throw new Error('Failed to collect module log');
                }

                sendJson([
                    'status' => 'success',
                    'message' => 'Module created successfully',
                    'redirect' => BASE_URL . 'admin/module_list'
                ]);
                exit;
            } else {
                sendJson([
                    'status' => 'error',
                    'message' => 'Failed to create module',
                    'redirect' => BASE_URL . 'admin/module/create'
                ]);
                exit;
            }
        } else {
            sendJson([
                'status' => 'error',
                'message' => 'Failed to create module',
                'redirect' => BASE_URL . 'admin/module/create'
            ]);
            exit;
        }
    }

    public function moduleEditForm() {
        adminAuth();

        global $db;
        $uri_array = explode('/', $_SERVER['REQUEST_URI']);
        $module_id = end($uri_array);

        $module = Module::getModuleById($db, $module_id) ?? false;

        if ($module) {
            $view = ViewController::getInstance();
            $view->set('title', 'Editing a module');
            $view->set('disable_scroll', true);
            $view->set('module', $module);
            $view->render('adminModuleEditForm');
        }
    }

    public function editModule() {
        adminAuth();

        global $db;
        $uri_array = explode('/', $_SERVER['REQUEST_URI']);
        $module_id = end($uri_array);

        if (isset($_POST['submit'])) {

            $result = Module::updateModule($db, $module_id);

            if ($result) {
                // collect admin audit logs
                $log_result = Log::collectLog($db, $module_id, 'update', 'module') ?? null;

                if ($log_result === null || !$log_result) {
                    throw new Error('Failed to collect user log');
                }

                sendJson([
                    'status' => 'success',
                    'message' => 'Module edited successfully',
                    'redirect' => BASE_URL . 'admin/module_list'
                ]);
                exit;
            } else {
                sendJson([
                    'status' => 'error',
                    'message' => 'Failed to edit module',
                    'redirect' => BASE_URL . 'admin/module/edit' . $module_id
                ]);
                exit;
            }
        } else {
            sendJson([
                'status' => 'error',
                'message' => 'Failed to edit module',
                'redirect' => BASE_URL . 'admin/module/edit' . $module_id
            ]);
            exit;
        }
    }

    public function deleteModule() {
        adminAuth();

        global $db;
        $uri_array = explode('/', $_SERVER['REQUEST_URI']);
        $module_id = end($uri_array);

        $result = Module::deleteModule($db, $module_id);

        // if ($result) {
        //     sendJson([
        //         'status' => 'success',
        //         'message' => 'Module deleted successfully',
        //     ]);
        // } else {
        //     sendJson([
        //         'status' => 'error',
        //         'message' => 'Failed to delete module',
        //     ]);
        // }

        header('Location: ' . BASE_URL . 'admin/module_list');
        exit;
    }

    public function post() {
        adminAuth();

        global $db;
        $posts = Post::getAllPosts($db);

        foreach ($posts as &$post) {
            $post['post_at'] = dateFormat($post['post_at']);
        }

        if (!empty($posts)) {
            sendJson(['posts' => $posts]);
        }
    }

    public function deletePost() {
        adminAuth();

        global $db;
        $uri_array = explode('/', $_SERVER['REQUEST_URI']);
        $post_id = end($uri_array);
        
        
        $result = Post::deletePostById($db, $post_id);

        if ($result) {
            header('Location: ' . BASE_URL . 'admin');
            exit;
        } else {
            header('Location: ' . BASE_URL . 'error');
            exit;
        }

    }

    public function message() {
        adminAuth();

        global $db;
        $messages = Message::getAllMessages($db);

        // format message data
        foreach($messages as &$message) {
            $message['sent_at'] = dateFormat($message['sent_at']);
            $message['updated_at'] = dateFormat($message['updated_at']);
        }

        if (!empty($messages)) {
            sendJson([
                'messages' => $messages
            ]);
        }
    }

    public function showMessage() {
        adminAuth();

        global $db;
        $uri_array = explode('/', $_SERVER['REQUEST_URI']);
        $message_id = end($uri_array);
        $message = Message::getUserMessage($db, $message_id);

        // echo $message['status'];

        if ($message['status'] === 'unread') {
            Message::updateStatus($db, 'read', $message_id);
        }

        $view = ViewController::getInstance();
        $view->set('title', 'Viewing ' . $message['title']);
        $view->set('disable_scroll', false);
        $view->set('message', $message);
        $view->render('adminMessageView');
    }


}

?>