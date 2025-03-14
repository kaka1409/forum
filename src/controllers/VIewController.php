<?php

class ViewController {
    private $layout;
    private $data = [];

    public function __construct($layout = 'layout') {
        $this->layout = $layout;
    }

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

        ob_start();
        require_once APP_ROOT . "/views/layouts/{$this->layout}.html.php";
    }

    public static function useComponent($name, $data = []) {
        extract($data);
        ob_start();
        require_once APP_ROOT . "/views/components/{$name}.html.php";
        return ob_get_clean();
    }
}

?>