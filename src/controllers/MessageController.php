<?php

class MessageController {
    public function emailForm() {
        global $db;

        $messages = Message::getAllAccountMessages($db);
        // print_r(empty($messages));

        $view = ViewController::getInstance();
        $view->set('title', 'Message');
        $view->set('messages', $messages);
        $view->set('disable_scroll', true);
        $view->render('email');
    }

    public function create() {
        global $db;

        // not logged in
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'email');
            exit;
        }

        if (isset($_POST['submit'])) {

            $result = Message::createMessage($db);

            if ($result) {
                header('Location: ' . BASE_URL . 'email');
                exit;
            } else {
                header('Location: ' . BASE_URL . 'email');
                exit;
            }

        } else {
            header('Location: ' . BASE_URL . 'email');
            exit;
        }
    }

    public function show() {
        global $db;
        $uri_array = explode('/', $_SERVER['REQUEST_URI']);
        $message_id = end($uri_array);

        $message = Message::getUserMessage($db, $message_id) ?? null;

        if ($message['account_id'] !== $_SESSION['account_id']) {
            header('Location: ' . BASE_URL . 'home');
            exit;
        }

        $view = ViewController::getInstance();
        $view->set('title', 'Viewing ' . $message['title']);
        $view->set('message', $message);
        $view->render('messageView');
    }

    public function delete() {

        global $db;
        $uri_array = explode('/', $_SERVER['REQUEST_URI']);
        $message_id = end($uri_array);
        $account_id = Message::getUserMessage($db, $message_id)['account_id'];


        if (isAdmin()) {
            $result = Message::deleteMessage($db, $message_id);

            if ($result) {
                header('Location: ' . BASE_URL . 'admin/message_list');
                exit;
            } else {
                header('Location: ' . BASE_URL . 'admin/message/' . $message_id);
                exit;
            }
        } else {
            header('Location: ' . BASE_URL . 'admin/message/' . $message_id);
            exit;
        }

        if ($_SESSION['account_id'] === $account_id) {
            
            $result = Message::deleteMessage($db, $message_id);

            if ($result) {
                
            } else {
                header('Location: ' . BASE_URL . 'email');
                exit;
            }
        } else {
            header('Location: ' . BASE_URL . 'email');
            exit;
        }


    }
}

?>