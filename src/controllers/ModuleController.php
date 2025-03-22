<?php

class ModuleController {
    public function show() {
        $view = ViewController::getInstance();
        $view->set('title', 'Modules');
        $view->render('moduleList');
    }

}

?>