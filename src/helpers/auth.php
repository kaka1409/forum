<?php

function isLoggedIn() {
    return isset($_SESSION['account_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: ' . BASE_URL . 'login');
        exit;
    }
}

function isAdmin() {
    return isLoggedIn() && $_SESSION['role_id'] == 2;
}

?>