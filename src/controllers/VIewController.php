<?php

// apply singleton pattern for ViewController class

class ViewController {
    private $layout;
    private $data = [];
    private static $instance = null;

    private function __construct($layout = 'layout') {
        $this->layout = $layout;
    }

    // prevent cloning and unserialize of the instance
    private function __clone() {}
    public function __wakeup() {}


    public function set($key, $value) {
        // change components's data
        $this->data[$key] = $value;
    }

    public function render($page_name) {
        // render(include) a page

        extract($this->data);

        ob_start();
        require_once APP_ROOT . "/views/pages/{$page_name}.html.php";
        $content = ob_get_clean();

        require_once APP_ROOT . "/views/layouts/{$this->layout}.html.php";
        return $content;
    }

    public static function useComponent($name, $data = []) {
        extract($data);
        ob_start();
        include APP_ROOT . "/views/components/{$name}.html.php";
        return ob_get_clean();
    }

    public static function getInstance($layout = 'layout') {
        if (self::$instance === null) {
            self::$instance = new ViewController($layout);
        }

        return self::$instance;
    }
}

?>