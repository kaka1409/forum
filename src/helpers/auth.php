<?php

function isLoggedIn() {
    return isset($_SESSION['account_id']);
}

function authStatusJS() {
    echo '<script>';
    echo 'const isLoggedIn = ' . (isLoggedIn() ? 'true' : 'false');
    echo '</script>';
}

function isAdmin() {
    return isLoggedIn() && $_SESSION['role_id'] == 2;
}

?>