<?php

class Session {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            // session_set_cookie_params(0);
            session_start();
        }
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function get($key) {
        return $_SESSION[$key] ?? null;
    }

    public function destroy() {
        session_destroy();
    }

    public function generateCsrfToken() {
        $token = bin2hex(random_bytes(32));
        $this->set('csrf_token', $token);
        return $token;
    }

    public function validateCsrfToken($token) {
        return $token === $this->get('csrf_token');
    }
} 

?>