<?php

function sendJson($data) {
    header('Content-Type: application/json; charset=utf-8');
    echo trim(json_encode($data, JSON_PRETTY_PRINT));
    exit;
}

?>
