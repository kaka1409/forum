<?php

class Account {

    public static function authenticate($db, $email, $password) {
        $sql = "SELECT * FROM `account` WHERE email = :email;";
        $stmt = $db->query($sql, [
            ':email' => $email
        ]);
        
        if ($stmt->rowCount() > 0) {
            $account = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $account['password_hash'])) {
                return $account;
            }
        }

        return false;
    }

    public static function login($db) {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $account = self::authenticate($db, $email, $password);
        if ($account) {
            $session = new Session();

            $session->set('account_id', $account['account_id']);
            $session->set('account_name', $account['account_name']);
            $session->set('account_avatar', $account['account_avatar']);
            $session->set('role_id', $account['role_id']);
            return true;
        }
    
        return false;
    }

    public static function register($db) {
        $username = trim($_POST['username']);
        $email = $_POST['email'];
        $password = trim($_POST['password']);
    
        $sql = "INSERT INTO `account`(`user_id`, `role_id`, `account_name`, `account_avatar`, `password_hash`, `email`, `create_at`) 
                VALUES (:user_id, :role_id, :username, :account_avatar, :password_hash, :email, NOW())";

        $stmt = $db->query($sql, [
            ':user_id' => 2,
            ':role_id' => 1,
            ':username' => $username,
            ':account_avatar' => 'uploads/account/default.jpg',
            ':password_hash' => password_hash($password, PASSWORD_DEFAULT),
            ':email' => $email,
        ]);

        return $stmt;
    
    }
}

?>