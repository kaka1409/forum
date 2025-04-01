<?php

class EmailController {
    public function emailForm() {
        global $db;

        $messages = Message::getAllMessages($db);
        // print_r(empty($messages));

        $view = ViewController::getInstance();
        $view->set('title', 'Message');
        $view->set('messages', $messages);
        $view->set('disable_scroll', true);
        $view->render('email');
    }

    public function email() {
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
}

?>