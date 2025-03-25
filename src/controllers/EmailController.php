<?php

class EmailController {
    public function email() {
        $view = ViewController::getInstance();
        $view->set('title', 'Message');
        $view->render('email');
    }
}

?>