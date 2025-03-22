<!-- module view -->

<?php

global $db;

$uri_array = explode('/', $_SERVER['REQUEST_URI']);

$module_id = end($uri_array);

$post_count = Module::countPostById($db, $module_id);

?>